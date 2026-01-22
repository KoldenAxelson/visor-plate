<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Order Summary - VisorPlate</title>
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
        .summary-badge {
            background: linear-gradient(135deg, #b87333 0%, #c29049 100%);
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 8px;
            margin: 20px;
            text-align: center;
        }
        .summary-badge .count {
            font-size: 36px;
            font-weight: 700;
            margin: 0;
        }
        .summary-badge .label {
            font-size: 14px;
            margin: 5px 0 0 0;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stats-row {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            background: #f9f9f9;
            margin: 0 20px 20px 20px;
            border-radius: 8px;
        }
        .stat {
            text-align: center;
        }
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #b87333;
            margin: 0;
        }
        .stat-label {
            font-size: 12px;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 5px 0 0 0;
        }
        .email-body {
            padding: 20px 30px;
        }
        .order-list {
            margin: 20px 0;
        }
        .order-item {
            background: #f9f9f9;
            border-left: 4px solid #b87333;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 4px;
        }
        .order-item:last-child {
            margin-bottom: 0;
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .order-number {
            font-weight: 700;
            color: #333333;
            font-size: 16px;
        }
        .order-amount {
            font-weight: 700;
            color: #b87333;
            font-size: 16px;
        }
        .order-details {
            font-size: 14px;
            color: #666666;
            line-height: 1.8;
        }
        .order-details strong {
            color: #333333;
        }
        .action-section {
            background: linear-gradient(135deg, #e8f4f8 0%, #d1e9f3 100%);
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .action-section h3 {
            margin: 0 0 10px 0;
            color: #0066aa;
            font-size: 18px;
        }
        .action-section p {
            margin: 0;
            color: #0066aa;
            font-size: 14px;
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
        .timestamp {
            color: #999999;
            font-size: 12px;
            text-align: center;
            padding: 10px;
        }
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 10px;
            }
            .email-body {
                padding: 20px;
            }
            .stats-row {
                flex-direction: column;
                gap: 15px;
            }
            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <div class="icon">🖨️</div>
                <h1>Daily Order Summary</h1>
            </div>

            <!-- Summary Badge -->
            <div class="summary-badge">
                <p class="count">{{ $orderCount }}</p>
                <p class="label">{{ Str::plural('Order', $orderCount) }} to Print Today</p>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat">
                    <p class="stat-value">{{ $orders->sum('quantity') }}</p>
                    <p class="stat-label">Total Units</p>
                </div>
                <div class="stat">
                    <p class="stat-value">${{ number_format($totalRevenue, 2) }}</p>
                    <p class="stat-label">Total Revenue</p>
                </div>
            </div>

            <!-- Body -->
            <div class="email-body">
                <p style="font-size: 16px; margin-bottom: 20px;">
                    <strong>Good morning!</strong> Here are today's orders ready for printing and shipping:
                </p>

                <!-- Order List -->
                <div class="order-list">
                    @foreach($orders as $order)
                    <div class="order-item">
                        <div class="order-header">
                            <span class="order-number">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                            <span class="order-amount">${{ number_format($order->total, 2) }}</span>
                        </div>
                        <div class="order-details">
                            <strong>Customer:</strong> {{ $order->name }}<br>
                            <strong>Quantity:</strong> {{ $order->quantity }} {{ Str::plural('unit', $order->quantity) }}<br>
                            <strong>Location:</strong> {{ $order->shipping_address['city'] ?? 'N/A' }}, {{ $order->shipping_address['state'] ?? 'N/A' }}<br>
                            <strong>Ordered:</strong> {{ $order->created_at->format('M j, g:i A') }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Action Section -->
                <div class="action-section">
                    <h3>🤖 Auto-Print Status</h3>
                    <p>Rollo is printing labels now. Orders will be ready to pack shortly!</p>
                </div>

                <p style="margin-top: 30px; font-size: 14px; color: #666666;">
                    <strong>Next Steps:</strong><br>
                    1. Labels are printing automatically via Rollo<br>
                    2. Pack each order with the printed label<br>
                    3. Drop off at USPS or schedule pickup<br>
                    4. Customers will receive tracking emails automatically
                </p>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p><strong>VisorPlate Order Management</strong></p>
                <p>Automated Daily Summary</p>
            </div>

            <!-- Timestamp -->
            <div class="timestamp">
                Sent: {{ now()->format('F j, Y g:i A T') }}
            </div>
        </div>
    </div>
</body>
</html>
