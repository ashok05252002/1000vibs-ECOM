<?php

namespace Webkul\Payment\Payment;

use Illuminate\Support\Facades\Storage;

class CashOnDelivery extends Payment
{
    /**
     * Payment method code.
     *
     * @var string
     */
    protected $code = 'cashondelivery';

    /**
     * Get redirect url.
     *
     * @return string|null
     */
    public function getRedirectUrl()
    {
        $advanceStatus = $this->getConfigData('advance_delivery_fee_status');

        if ($advanceStatus === null || $advanceStatus == 1 || $advanceStatus === true) {
            return route('partial_cod.process');
        }

        return null;
    }

    /**
     * Is available.
     *
     * @return bool
     */
    public function isAvailable()
    {
        if (! $this->cart) {
            $this->setCart();
        }

        return $this->getConfigData('active') && $this->cart?->haveStockableItems();
    }

    /**
     * Get payment method image.
     *
     * @return array
     */
    public function getImage()
    {
        $url = $this->getConfigData('image');

        return $url ? Storage::url($url) : bagisto_asset('images/cash-on-delivery.png', 'shop');
    }
}
