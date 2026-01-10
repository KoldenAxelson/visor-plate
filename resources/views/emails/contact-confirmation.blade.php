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
            background-color: #0d0d0d;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #1a1a1a;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .header {
            background: linear-gradient(135deg, #b87333, #c29049);
            color: #fff;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 300;
            letter-spacing: 0.05em;
        }
        .header p {
            margin: 0;
            opacity: 0.9;
            font-size: 15px;
        }
        .icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
        }
        .content {
            padding: 40px 30px;
            color: #e5e5e5;
        }
        .content p {
            margin: 0 0 20px 0;
            line-height: 1.8;
        }
        .info-box {
            background: rgba(184, 115, 51, 0.1);
            border: 1px solid rgba(184, 115, 51, 0.3);
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #b87333;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.05em;
        }
        .info-box p {
            margin: 0;
            color: #999;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #b87333, #c29049);
            color: #000;
            padding: 14px 32px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.05em;
            margin: 20px 0;
        }
        .footer {
            background: rgba(255,255,255,0.02);
            padding: 30px;
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
        .footer p {
            margin: 0 0 10px 0;
            font-size: 13px;
            color: #999;
        }
        .footer a {
            color: #b87333;
            text-decoration: none;
        }
        .divider {
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">✓</div>
            <h1>We Got Your Message!</h1>
            <p>Thank you for reaching out to VisorPlate</p>
        </div>

        <div class="content">
            <p>Hi {{ $name }},</p>
            
            <p>Thank you for contacting us! We've received your {{ $inquiry_type === 'wholesale' ? 'wholesale inquiry' : 'message' }} and our team will get back to you within 24 hours.</p>

            @if($inquiry_type === 'wholesale')
                <div class="info-box">
                    <h3>🏢 Wholesale Inquiry Details</h3>
                    <p><strong>Company:</strong> {{ $company }}</p>
                    <p><strong>Quantity:</strong> {{ number_format($quantity) }} units</p>
                    <p style="margin-top: 15px; color: #b87333;">Our wholesale team will reach out to you shortly to discuss pricing and logistics.</p>
                </div>
            @endif

            <div class="divider"></div>

            <p><strong>What happens next?</strong></p>
            <ul style="color: #999; line-height: 2;">
                <li>We'll review your {{ $inquiry_type === 'wholesale' ? 'inquiry' : 'message' }} thoroughly</li>
                <li>A team member will respond within 24 hours</li>
                <li>{{ $inquiry_type === 'wholesale' ? 'We\'ll prepare a custom quote for your order' : 'We\'ll answer all your questions' }}</li>
            </ul>

            <div class="divider"></div>

            <p style="text-align: center;">
                <a href="https://visorplate.com/shop" class="button">Shop VisorPlate</a>
            </p>

            <p style="font-size: 14px; color: #999; margin-top: 30px;">
                In the meantime, if you have any urgent questions, feel free to reply to this email.
            </p>
        </div>

        <div class="footer">
            <p><strong style="color: #b87333;">VisorPlate</strong></p>
            <p>Premium No-Drill License Plate Solution</p>
            <p style="margin-top: 20px;">
                <a href="mailto:support@visorplate.com">support@visorplate.com</a> • 
                <a href="tel:+15551234567">(555) 123-4567</a>
            </p>
            <p style="margin-top: 20px; font-size: 11px; color: #666;">
                You're receiving this email because you contacted us through our website.
            </p>
        </div>
    </div>
</body>
</html>
