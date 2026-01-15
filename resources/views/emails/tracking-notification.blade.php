<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your VisorPlate Has Shipped</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333333;
            line-height: 1.6;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-container {
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 28px;
            font-weight: 300;
            letter-spacing: 0.05em;
        }
        .email-header .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .email-body {
            padding: 40px 30px;
        }
        .email-body h2 {
            color: #b87333;
            font-size: 24px;
            font-weight: 400;
            margin: 0 0 20px 0;
        }
        .email-body p {
            margin: 0 0 15px 0;
            color: #555555;
            font-size: 16px;
        }
        .order-details {
            background: #f9f9f9;
            border-left: 4px solid #b87333;
            padding: 20px;
            margin: 25px 0;
        }
        .order-details .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eeeeee;
        }
        .order-details .detail-row:last-child {
            border-bottom: none;
        }
        .order-details .label {
            font-weight: 600;
            color: #333333;
        }
        .order-details .value {
            color: #666666;
        }
        .tracking-button {
            display: inline-block;
            background: linear-gradient(135deg, #b87333 0%, #c29049 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 16px 40px;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 500;
            margin: 20px 0;
            text-align: center;
            transition: transform 0.2s;
        }
        .tracking-button:hover {
            transform: translateY(-2px);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .delivery-info {
            background: #e8f4f8;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .delivery-info p {
            margin: 5px 0;
            color: #0066aa;
            font-weight: 500;
        }
        .email-footer {
            background: #f9f9f9;
            padding: 30px;
            text-align: center;
            color: #888888;
            font-size: 14px;
        }
        .email-footer p {
            margin: 5px 0;
        }
        .email-footer a {
            color: #b87333;
            text-decoration: none;
        }
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 10px;
            }
            .email-body {
                padding: 30px 20px;
            }
            .order-details .detail-row {
                flex-direction: column;
            }
            .order-details .value {
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <div class="icon">📦</div>
                <h1>Your Order Has Shipped!</h1>
            </div>

            <!-- Body -->
            <div class="email-body">
                <h2>Hi {{ $order->name }},</h2>
                
                <p>Great news! Your VisorPlate order has been shipped and is on its way to you.</p>

                <!-- Order Details -->
                <div class="order-details">
                    <div class="detail-row">
                        <span class="label">Order Number:</span>
                        <span class="value">#{{ $orderNumber }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Quantity:</span>
                        <span class="value">{{ $order->quantity }} {{ Str::plural('unit', $order->quantity) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Tracking Number:</span>
                        <span class="value">{{ $order->tracking_number }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Shipped:</span>
                        <span class="value">{{ $order->shipped_at->format('F j, Y') }}</span>
                    </div>
                </div>

                <!-- Tracking Button -->
                <div class="button-container">
                    <a href="{{ $trackingUrl }}" class="tracking-button">
                        Track Your Package
                    </a>
                </div>

                <!-- Delivery Info -->
                <div class="delivery-info">
                    <p>📅 Expected Delivery: 3-5 Business Days</p>
                    <p>📍 Carrier: USPS First Class Package</p>
                </div>

                <p>Your VisorPlate is heading to:</p>
                <p style="padding-left: 20px; color: #666666;">
                    {{ $order->shipping_address['line1'] }}<br>
                    @if(!empty($order->shipping_address['line2']))
                        {{ $order->shipping_address['line2'] }}<br>
                    @endif
                    {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} {{ $order->shipping_address['postal_code'] }}
                </p>

                <p style="margin-top: 30px;">If you have any questions about your order, just reply to this email. We're here to help!</p>

                <p style="margin-top: 30px; font-weight: 500;">Thanks for choosing VisorPlate! 🚗</p>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p><strong>VisorPlate</strong></p>
                <p>Luxury License Plate Solutions</p>
                <p style="margin-top: 15px;">
                    Questions? Email us at <a href="mailto:contact@visorplate.com">contact@visorplate.com</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
