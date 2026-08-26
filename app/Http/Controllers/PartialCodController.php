<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\OrderTransactionRepository;
use Webkul\Sales\Transformers\OrderResource;

class PartialCodController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected OrderTransactionRepository $orderTransactionRepository
    ) {}

    /**
     * Initiates Razorpay payment specifically for Advance COD Delivery Fee (₹120).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function redirect(Request $request)
    {
        $cart = Cart::getCart();

        if (! $cart || ! $cart->items->count()) {
            session()->flash('error', trans('shop::app.checkout.cart.index.empty-product'));

            return redirect()->route('shop.checkout.cart.index');
        }

        $billingAddress = $cart->billing_address;

        if (! $billingAddress) {
            session()->flash('error', trans('shop::app.checkout.onepage.address.check-billing-address'));

            return redirect()->route('shop.checkout.onepage.index');
        }

        $advanceAmount = (float) (core()->getConfigData('sales.payment_methods.cashondelivery.advance_delivery_fee_amount') ?: 120);

        $keyId = core()->getConfigData('sales.payment_methods.razorpay.key_id') ?: env('RAZORPAY_KEY');
        $keySecret = core()->getConfigData('sales.payment_methods.razorpay.secret') ?: env('RAZORPAY_SECRET');

        $razorpaySdkPath = base_path('vendor/vfixtechnology/bagisto-razorpay/src/razorpay-php/Razorpay.php');

        if (file_exists($razorpaySdkPath)) {
            include_once $razorpaySdkPath;
        }

        try {
            $api = new \Razorpay\Api\Api($keyId, $keySecret);

            $orderData = [
                'receipt'         => 'COD-ADV-' . $cart->id . '-' . time(),
                'amount'          => round($advanceAmount * 100), // in paise (e.g. 12000 for ₹120)
                'currency'        => 'INR',
                'payment_capture' => 1,
                'notes'           => [
                    'cart_id'       => (string) $cart->id,
                    'customer_name' => $billingAddress->name,
                    'customer_phone'=> $billingAddress->phone,
                    'purpose'       => 'Advance Delivery Charge for COD Order',
                ],
            ];

            $razorpayOrder = $api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];

            $request->session()->put('partial_cod_razorpay_order_id', $razorpayOrderId);
            $request->session()->put('partial_cod_advance_amount', $advanceAmount);

            $data = [
                'key'          => $keyId,
                'amount'       => $orderData['amount'],
                'name'         => config('app.name', '1000Vibes'),
                'description'  => 'Advance Delivery Fee for COD Order #' . $cart->id,
                'prefill'      => [
                    'name'    => $billingAddress->name,
                    'email'   => $billingAddress->email,
                    'contact' => $billingAddress->phone,
                ],
                'notes'        => [
                    'cart_id'      => $cart->id,
                    'payment_type' => 'partial_cod_advance_fee',
                ],
                'theme'        => [
                    'color' => '#00438b',
                ],
                'order_id'     => $razorpayOrderId,
                'callback_url' => route('partial_cod.callback'),
            ];

            $json = json_encode($data);

            return view('shop::checkout.partial-cod-redirect', compact('data', 'json'));
        } catch (\Exception $e) {
            Log::error('Partial COD Razorpay Order Creation Failed: ' . $e->getMessage());

            session()->flash('error', 'Unable to initiate advance payment. Error: ' . $e->getMessage());

            return redirect()->route('shop.checkout.onepage.index');
        }
    }

    /**
     * Verifies the Razorpay payment for advance COD fee and places the order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $razorpaySdkPath = base_path('vendor/vfixtechnology/bagisto-razorpay/src/razorpay-php/Razorpay.php');

        if (file_exists($razorpaySdkPath)) {
            include_once $razorpaySdkPath;
        }

        $keyId = core()->getConfigData('sales.payment_methods.razorpay.key_id') ?: env('RAZORPAY_KEY');
        $keySecret = core()->getConfigData('sales.payment_methods.razorpay.secret') ?: env('RAZORPAY_SECRET');

        $paymentId = $request->input('razorpay_payment_id');
        $signature = $request->input('razorpay_signature');
        $razorpayOrderId = $request->session()->get('partial_cod_razorpay_order_id') ?: $request->input('razorpay_order_id');
        $advanceAmount = (float) ($request->session()->get('partial_cod_advance_amount') ?: core()->getConfigData('sales.payment_methods.cashondelivery.advance_delivery_fee_amount') ?: 120);

        $success = false;
        $errorMessage = 'Payment verification failed.';

        if (! empty($paymentId)) {
            try {
                $api = new \Razorpay\Api\Api($keyId, $keySecret);

                $attributes = [
                    'razorpay_order_id'   => $razorpayOrderId,
                    'razorpay_payment_id' => $paymentId,
                    'razorpay_signature'  => $signature,
                ];

                $api->utility->verifyPaymentSignature($attributes);
                $success = true;
            } catch (\Exception $e) {
                $success = false;
                $errorMessage = 'Razorpay Error: ' . $e->getMessage();
                Log::error('Partial COD Signature Verification Error: ' . $e->getMessage());
            }
        }

        if ($success === true) {
            $cart = Cart::getCart();

            if (! $cart) {
                session()->flash('error', 'Cart session expired. If amount of ₹' . $advanceAmount . ' was deducted, please contact support with Txn ID: ' . $paymentId);

                return redirect()->route('shop.checkout.cart.index');
            }

            try {
                // Prepare order data from cart
                $data = (new OrderResource($cart))->jsonSerialize();

                // Assign ₹120 advance delivery fee as shipping
                $data['shipping_amount'] = $advanceAmount;
                $data['base_shipping_amount'] = $advanceAmount;
                $data['shipping_amount_incl_tax'] = $advanceAmount;
                $data['base_shipping_amount_incl_tax'] = $advanceAmount;
                $data['shipping_title'] = 'Cash On Delivery - Delivery Charge Paid Online (₹' . number_format($advanceAmount, 2) . ')';

                // Calculate grand total including advance delivery fee
                $subTotal = (float) $cart->sub_total;
                $taxTotal = (float) $cart->tax_total;
                $discount = (float) $cart->discount_amount;
                $orderTotal = round(($subTotal + $taxTotal + $advanceAmount) - $discount, 2);
                $codBalanceDue = round($orderTotal - $advanceAmount, 2);

                $data['grand_total'] = $orderTotal;
                $data['base_grand_total'] = $orderTotal;
                $data['grand_total_invoiced'] = $advanceAmount;
                $data['base_grand_total_invoiced'] = $advanceAmount;

                $data['payment'] = [
                    'method'       => 'cashondelivery',
                    'method_title' => 'Cash On Delivery (₹' . number_format($advanceAmount, 2) . ' Paid Online)',
                    'additional'   => [
                        'advance_paid'        => $advanceAmount,
                        'razorpay_payment_id' => $paymentId,
                        'razorpay_order_id'   => $razorpayOrderId,
                        'cod_balance_due'     => $codBalanceDue,
                        'is_partial_cod'      => true,
                    ],
                ];

                $order = $this->orderRepository->create($data);
                $this->orderRepository->update(['status' => 'processing'], $order->id);

                // Record transaction for ₹120 advance online payment
                try {
                    $this->orderTransactionRepository->create([
                        'transaction_id' => $paymentId,
                        'status'         => 'paid',
                        'type'           => 'cashondelivery',
                        'payment_method' => 'cashondelivery',
                        'order_id'       => $order->id,
                        'amount'         => $advanceAmount,
                        'data'           => json_encode([
                            'razorpay_payment_id' => $paymentId,
                            'razorpay_order_id'   => $razorpayOrderId,
                            'type'                => 'partial_cod_advance_fee',
                            'cod_balance_due'     => $codBalanceDue,
                        ]),
                    ]);
                } catch (\Exception $e) {
                    Log::warning('Partial COD Transaction creation skipped: ' . $e->getMessage());
                }

                Cart::deActivateCart();
                session()->flash('order_id', $order->id);

                return redirect()->route('shop.checkout.onepage.success');
            } catch (\Exception $e) {
                Log::error('Partial COD Order creation failed: ' . $e->getMessage());
                session()->flash('error', 'Error creating order: ' . $e->getMessage());

                return redirect()->route('shop.checkout.onepage.index');
            }
        } else {
            session()->flash('error', 'Advance delivery fee payment was cancelled or failed. Your COD order was not placed.');

            return redirect()->route('shop.checkout.onepage.index');
        }
    }
}
