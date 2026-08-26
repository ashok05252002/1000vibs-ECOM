<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advance Delivery Fee Payment - {{ config('app.name', '1000Vibes') }}</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .payment-card {
            background: #ffffff;
            padding: 36px 32px;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            text-align: center;
            max-width: 440px;
            width: 90%;
            border: 1px solid #e2e8f0;
        }

        .spinner {
            width: 48px;
            height: 48px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #00438b;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        h2 {
            font-size: 20px;
            color: #0f172a;
            margin: 0 0 8px 0;
            font-weight: 700;
        }

        p {
            font-size: 14px;
            color: #475569;
            margin: 0 0 20px 0;
            line-height: 1.5;
        }

        .amount-badge {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .note {
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #f1f5f9;
            padding-top: 16px;
            line-height: 1.4;
        }

        .cancel-link {
            display: inline-block;
            margin-top: 16px;
            color: #94a3b8;
            font-size: 13px;
            text-decoration: underline;
            cursor: pointer;
            padding: 8px 12px;
        }
        .cancel-link:hover {
            color: #ef4444;
        }

        @media (max-width: 480px) {
            .payment-card {
                padding: 24px 18px;
                border-radius: 16px;
            }
            h2 {
                font-size: 18px;
            }
            p {
                font-size: 13px;
            }
            .amount-badge {
                font-size: 18px;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="payment-card">
        <div class="spinner"></div>
        <h2>Opening Razorpay Gateway...</h2>
        <p>Please pay the <strong>₹{{ number_format(($data['amount'] ?? 12000)/100, 2) }}</strong> advance delivery charge to confirm your Cash on Delivery order.</p>
        
        <div class="amount-badge">
            Advance Amount: ₹{{ number_format(($data['amount'] ?? 12000)/100, 2) }}
        </div>

        <div class="note">
            ✓ Remaining order balance will be collected in cash upon delivery.<br>
            Please do not close or refresh this window while payment is processing.
        </div>

        <div>
            <a href="{{ route('shop.checkout.onepage.index') }}" class="cancel-link">Cancel and return to checkout</a>
        </div>
    </div>

    <form name='partialcodform' action="{{ route('partial_cod.callback') }}" method="POST">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $data['order_id'] ?? '' }}">
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {!! $json !!};

        options.handler = function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            if (response.razorpay_order_id) {
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            }
            document.partialcodform.submit();
        };

        options.theme = options.theme || {};
        options.theme.image_padding = false;

        options.modal = {
            ondismiss: function() {
                window.location.href = "{{ route('shop.checkout.onepage.index') }}";
            },
            escape: false,
            backdropclose: false
        };

        var rzp = new Razorpay(options);

        window.onload = function(event) {
            rzp.open();
        };
    </script>
</body>
</html>
