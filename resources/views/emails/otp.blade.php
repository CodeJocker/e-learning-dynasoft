<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 8px;
            margin: 20px 0;
            color: #2563eb;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        
        <p>Hello,</p>
        
        <p>Thank you for registering! Please use the following OTP to verify your email address:</p>
        
        <div class="otp-code">{{ $otp }}</div>
        
        <p>This OTP will expire in 10 minutes.</p>
        
        <p>If you didn't request this OTP, please ignore this email.</p>
        
        <div class="footer">
            <p>This is an automated message from StudentPortal.</p>
        </div>
    </div>
</body>
</html>
