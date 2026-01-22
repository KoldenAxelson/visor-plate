<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Orders Today - VisorPlate</title>
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 40px 20px;
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
            font-size: 64px;
            margin-bottom: 15px;
        }
        .email-body {
            padding: 40px 30px;
            text-align: center;
        }
        .email-body h2 {
            color: #10b981;
            font-size: 24px;
            font-weight: 400;
            margin: 0 0 20px 0;
        }
        .email-body p {
            margin: 0 0 15px 0;
            color: #555555;
            font-size: 16px;
        }
        .stats-box {
            background: #f0fdf4;
            border: 2px solid #10b981;
            border-radius: 8px;
            padding: 30px;
            margin: 30px 0;
        }
        .stats-box .number {
            font-size: 72px;
            font-weight: 700;
            color: #10b981;
            margin: 0;
            line-height: 1;
        }
        .stats-box .label {
            font-size: 18px;
            color: #059669;
            margin: 10px 0 0 0;
            font-weight: 500;
        }
        .enjoy-section {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }
        .enjoy-section h3 {
            margin: 0 0 15px 0;
            color: #0369a1;
            font-size: 20px;
        }
        .enjoy-section ul {
            margin: 0;
            padding: 0;
            list-style: none;
            text-align: left;
            display: inline-block;
        }
        .enjoy-section li {
            padding: 8px 0;
            color: #0c4a6e;
            font-size: 15px;
        }
        .enjoy-section li:before {
            content: "✓ ";
            color: #0369a1;
            font-weight: bold;
            margin-right: 10px;
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
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <div class="icon">🎉</div>
                <h1>You're Free Today!</h1>
            </div>

            <!-- Body -->
            <div class="email-body">
                <h2>No Orders to Process</h2>

                <p style="font-size: 18px; margin-bottom: 30px;">
                    Good morning! Great news — there are no pending orders today.
                </p>

                <!-- Big Zero -->
                <div class="stats-box">
                    <p class="number">0</p>
                    <p class="label">Orders Pending</p>
                </div>

                <p style="font-size: 16px; color: #666666;">
                    No printing, no packing, no shipping. Take the day off! 🏖️
                </p>

                <!-- Enjoy Your Day -->
                <div class="enjoy-section">
                    <h3>Enjoy Your Day Off!</h3>
                    <ul>
                        <li>Sleep in without worrying</li>
                        <li>Work on marketing or product improvements</li>
                        <li>Catch up on other projects</li>
                        <li>Just relax and recharge</li>
                    </ul>
                </div>

                <p style="margin-top: 30px; font-size: 14px; color: #888888;">
                    We'll check again tomorrow. If orders come in later today, you'll receive the usual notification.
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
