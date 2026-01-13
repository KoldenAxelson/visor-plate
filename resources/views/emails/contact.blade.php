<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission - VisorPlate</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #b87333, #c29049);
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 1px;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: 600;
            color: #b87333;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        .field-value {
            color: #333;
            font-size: 15px;
        }
        .divider {
            border-top: 2px solid #e0e0e0;
            margin: 25px 0;
        }
        .badge {
            display: inline-block;
            background: linear-gradient(135deg, #b87333, #c29049);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        .stars {
            color: #b87333;
            font-size: 20px;
            letter-spacing: 2px;
        }
        .photo-container {
            margin-top: 10px;
            text-align: center;
        }
        .photo-link {
            display: inline-block;
            background: linear-gradient(135deg, #b87333, #c29049);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>
            @if($inquiry_type === 'wholesale')
                New Wholesale Inquiry
            @elseif($inquiry_type === 'return')
                Return Request
            @elseif($inquiry_type === 'review')
                Customer Review
            @else
                Contact Form Submission
            @endif
        </h1>
    </div>

    <div class="content">
        <div class="badge">
            @if($inquiry_type === 'wholesale')
                WHOLESALE
            @elseif($inquiry_type === 'return')
                RETURN REQUEST
            @elseif($inquiry_type === 'review')
                REVIEW
            @else
                GENERAL INQUIRY
            @endif
        </div>

        <div class="field">
            <div class="field-label">Name</div>
            <div class="field-value">{{ $name }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email</div>
            <div class="field-value">{{ $email }}</div>
        </div>

        @if($phone)
        <div class="field">
            <div class="field-label">Phone</div>
            <div class="field-value">{{ $phone }}</div>
        </div>
        @endif

        <div class="divider"></div>

        @if($inquiry_type === 'wholesale')
            <div class="field">
                <div class="field-label">Company</div>
                <div class="field-value">{{ $company }}</div>
            </div>

            <div class="field">
                <div class="field-label">Quantity</div>
                <div class="field-value">{{ number_format($quantity) }} units</div>
            </div>

            @if($user_message)
            <div class="field">
                <div class="field-label">Message</div>
                <div class="field-value">{{ $user_message }}</div>
            </div>
            @endif

        @elseif($inquiry_type === 'return')
            <div class="field">
                <div class="field-label">Order Number</div>
                <div class="field-value">{{ $order_number }}</div>
            </div>

            <div class="field">
                <div class="field-label">Return Reason</div>
                <div class="field-value">{{ $return_reason }}</div>
            </div>

            @if(isset($return_photo_url))
            <div class="field">
                <div class="field-label">Product Photo</div>
                <div class="photo-container">
                    <p><strong>Photo attached to this email (sanitized)</strong></p>
                    @if(isset($return_submission_date))
                    <p style="font-size: 12px; color: #888; margin-top: 10px;">
                        Submitted: {{ $return_submission_date }}<br>
                        Auto-delete after: {{ \Carbon\Carbon::parse($return_submission_date)->addDays(90)->format('Y-m-d') }}
                    </p>
                    @endif
                    <a href="{{ url($return_photo_url) }}" class="photo-link" style="margin-top: 10px; display: inline-block;">View on Server</a>
                </div>
            </div>
            @endif

            @if($user_message)
            <div class="field">
                <div class="field-label">Additional Comments</div>
                <div class="field-value">{{ $user_message }}</div>
            </div>
            @endif

        @elseif($inquiry_type === 'review')
            <div class="field">
                <div class="field-label">Review Title</div>
                <div class="field-value"><strong>{{ $review_title }}</strong></div>
            </div>

            <div class="field">
                <div class="field-label">Rating</div>
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $rating)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                    ({{ $rating }}/5)
                </div>
            </div>

            <div class="field">
                <div class="field-label">Review</div>
                <div class="field-value">{{ $review_text }}</div>
            </div>

            @if(isset($ride_photo))
            <div class="field">
                <div class="field-label">Ride Photo</div>
                <div class="photo-container">
                    <p><strong>Photo attached to this email</strong></p>
                    <p style="font-size: 12px; color: #888; margin-top: 5px;">
                        (Not stored on server - manually curate if you want to use it)
                    </p>
                </div>
            </div>
            @endif

            @if($user_message)
            <div class="field">
                <div class="field-label">Additional Comments</div>
                <div class="field-value">{{ $user_message }}</div>
            </div>
            @endif

        @else
            <div class="field">
                <div class="field-label">Message</div>
                <div class="field-value">{{ $user_message }}</div>
            </div>
        @endif

        <div class="divider"></div>

        <div class="field">
            <div class="field-label">Submitted</div>
            <div class="field-value">{{ $submitted_at }}</div>
        </div>
    </div>
</body>
</html>
