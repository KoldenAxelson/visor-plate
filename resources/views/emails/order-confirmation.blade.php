<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background: linear-gradient(135deg, #0d0d0d 0%, #1c1c1e 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .logo {
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 2px;
            margin: 0;
        }
        .logo-gradient {
            background: linear-gradient(135deg, #b87333 0%, #c29049 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .content {
            padding: 40px 30px;
        }
        .success-badge {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            display: inline-block;
            font-weight: 600;
            margin-bottom: 20px;
        }
        h1 {
            color: #0d0d0d;
            font-size: 28px;
            font-weight: 300;
            margin: 0 0 10px 0;
        }
        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
        }
        .order-details {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin: 30px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #6b7280;
            font-size: 14px;
        }
        .detail-value {
            color: #111827;
            font-weight: 600;
        }
        .total-row {
            padding-top: 16px;
            margin-top: 16px;
            border-top: 2px solid #b87333;
        }
        .total-value {
            font-size: 24px;
            color: #b87333;
        }
        .shipping-address {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }
        .shipping-address h3 {
            margin: 0 0 12px 0;
            color: #0d0d0d;
            font-size: 18px;
            font-weight: 600;
        }
        .shipping-address p {
            margin: 4px 0;
            color: #374151;
        }
        .next-steps {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 12px;
            padding: 24px;
            margin: 30px 0;
        }
        .next-steps h3 {
            margin: 0 0 16px 0;
            color: #1e3a8a;
            font-size: 20px;
        }
        .step {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }
        .step:last-child {
            margin-bottom: 0;
        }
        .step-number {
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }
        .step-content {
            flex: 1;
        }
        .step-title {
            font-weight: 600;
            color: #1e3a8a;
            margin: 0 0 4px 0;
        }
        .step-description {
            color: #1e40af;
            font-size: 14px;
            margin: 0;
        }
        .guarantee {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .guarantee h3 {
            margin: 0 0 8px 0;
            color: #065f46;
            font-size: 18px;
        }
        .guarantee p {
            margin: 0;
            color: #047857;
            font-size: 14px;
        }
        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            color: #6b7280;
            font-size: 14px;
            margin: 8px 0;
        }
        .footer a {
            color: #b87333;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        @media only screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2 class="logo">
                <span class="logo-gradient">VisorPlate</span>
            </h2>
        </div>

        <!-- Content -->
        <div class="content">
            <div style="text-align: center;">
                <div class="success-badge">✓ Order Confirmed</div>
            </div>

            <h1>Thank you for your order!</h1>
            <p class="subtitle">
                Hi {{ $order->name }}, we've received your order and will process it shortly.
            </p>

            <!-- Order Details -->
            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Order Number</span>
                    <span class="detail-value">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Product</span>
                    <span class="detail-value">VisorPlate</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Quantity</span>
                    <span class="detail-value">{{ $order->quantity }} {{ Str::plural('unit', $order->quantity) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Subtotal</span>
                    <span class="detail-value">${{ number_format($order->total, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Shipping</span>
                    <span class="detail-value" style="color: #10b981;">FREE</span>
                </div>
                <div class="detail-row total-row">
                    <span class="detail-label" style="font-size: 18px; color: #111827;">Total</span>
                    <span class="detail-value total-value">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <!-- Shipping Address -->
            @if($order->shipping_address)
            <div class="shipping-address">
                <h3>Shipping Address</h3>
                <p>{{ $order->shipping_address['name'] }}</p>
                <p>{{ $order->shipping_address['line1'] }}</p>
                @if($order->shipping_address['line2'])
                    <p>{{ $order->shipping_address['line2'] }}</p>
                @endif
                <p>
                    {{ $order->shipping_address['city'] }},
                    {{ $order->shipping_address['state'] }}
                    {{ $order->shipping_address['postal_code'] }}
                </p>
            </div>
            @endif

            <!-- What's Next -->
            <div class="next-steps">
                <h3>What Happens Next?</h3>
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <p class="step-title">Order Processing</p>
                        <p class="step-description">We'll prepare your VisorPlate(s) for shipment within 1-2 business days.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <p class="step-title">Shipping Confirmation</p>
                        <p class="step-description">You'll receive tracking information via email as soon as your order ships.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <p class="step-title">Delivery (3-7 days)</p>
                        <p class="step-description">Your VisorPlate will arrive ready to install. Installation takes just 60 seconds!</p>
                    </div>
                </div>
            </div>

            <!-- 30-Day Guarantee -->
            <div class="guarantee">
                <h3>30-Day Money Back Guarantee</h3>
                <p>Not satisfied? Return it for a full refund. No questions asked.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Questions or concerns?</strong></p>
            <p>Email us at <a href="mailto:support@visorplate.com">support@visorplate.com</a></p>
            <p style="margin-top: 20px;">
                &copy; {{ date('Y') }} VisorPlate. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
