<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #b87333, #c29049);
            color: #fff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 0.05em;
        }
        .badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .field {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
        }
        .field:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 5px;
        }
        .value {
            color: #333;
            font-size: 15px;
        }
        .message-box {
            background: #f9f9f9;
            border-left: 3px solid #b87333;
            padding: 15px;
            margin-top: 5px;
            border-radius: 4px;
        }
        .footer {
            background: #f5f5f5;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        .wholesale-badge {
            background: #b87333;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            display: inline-block;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if($inquiry_type === 'wholesale')
                <div class="badge">WHOLESALE INQUIRY</div>
            @else
                <div class="badge">CONTACT FORM</div>
            @endif
            <h1>New {{ $inquiry_type === 'wholesale' ? 'Wholesale Inquiry' : 'Contact Form Submission' }}</h1>
        </div>

        <div class="content">
            @if($inquiry_type === 'wholesale')
                <div class="wholesale-badge">
                    🏢 Wholesale Order - {{ $quantity }} Units
                </div>
            @endif

            <div class="field">
                <div class="label">Name</div>
                <div class="value">{{ $name }}</div>
            </div>

            <div class="field">
                <div class="label">Email</div>
                <div class="value">
                    <a href="mailto:{{ $email }}" style="color: #b87333; text-decoration: none;">{{ $email }}</a>
                </div>
            </div>

            @if($phone)
            <div class="field">
                <div class="label">Phone</div>
                <div class="value">{{ $phone }}</div>
            </div>
            @endif

            @if($inquiry_type === 'wholesale')
                <div class="field">
                    <div class="label">Company</div>
                    <div class="value">{{ $company }}</div>
                </div>

                <div class="field">
                    <div class="label">Estimated Quantity</div>
                    <div class="value">{{ number_format($quantity) }} units</div>
                </div>
            @endif

            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">{{ $user_message }}</div>
            </div>

            <div class="field">
                <div class="label">Submitted</div>
                <div class="value">{{ $submitted_at }}</div>
            </div>
        </div>

        <div class="footer">
            <p>This email was sent from the VisorPlate contact form.</p>
            <p style="margin-top: 10px;">
                <a href="mailto:{{ $email }}" style="color: #b87333; text-decoration: none;">Reply to {{ $name }}</a>
            </p>
        </div>
    </div>
</body>
</html>
