<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .field {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .field:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #667eea;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .value {
            color: #333;
            font-size: 15px;
        }
        .message-box {
            background: #f9fafb;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #667eea;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 New Contact Form Submission</h1>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">From</div>
                <div class="value">{{ $contactData['name'] }}</div>
            </div>

            <div class="field">
                <div class="label">Email Address</div>
                <div class="value">
                    <a href="mailto:{{ $contactData['email'] }}" style="color: #667eea; text-decoration: none;">
                        {{ $contactData['email'] }}
                    </a>
                </div>
            </div>

            <div class="field">
                <div class="label">Subject</div>
                <div class="value">{{ $contactData['subject'] }}</div>
            </div>

            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">
                    {{ $contactData['message'] }}
                </div>
            </div>
        </div>

        <div class="footer">
            <p>This email was sent from the contact form on your website.</p>
            <p>Reply directly to this email to respond to {{ $contactData['name'] }}</p>
        </div>
    </div>
</body>
</html>
