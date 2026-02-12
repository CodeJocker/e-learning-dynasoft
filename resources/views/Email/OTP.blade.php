<!DOCTYPE html>
<html>
<head>
    <title>Email Verification - OTP Code</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #0f0f0f; color: #ffffff; margin: 0; padding: 40px 20px;">
    <div style="max-width: 480px; margin: 0 auto; background: #1a1a2e; padding: 40px; border-radius: 16px; border: 1px solid #2d2d44;">
        
        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 30px;">
            <span style="background: #2563eb; color: white; padding: 6px 14px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; border-radius: 8px; font-size: 14px;">E-Learn</span>
        </div>

        <!-- Heading -->
        <h2 style="color: #4ade80; text-align: center; margin: 0 0 10px 0; font-size: 22px;">
            Verify Your Email
        </h2>
        <p style="color: #a1a1aa; text-align: center; margin: 0 0 30px 0; font-size: 14px;">
            Use the code below to complete your student registration.
        </p>

        <!-- OTP Code -->
        <div style="background: #16213e; border: 2px dashed #4ade80; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 30px;">
            <p style="font-size: 36px; font-weight: bold; letter-spacing: 8px; margin: 0; color: #ffffff;">
                {{ $otp }}
            </p>
        </div>

        <!-- Info -->
        <p style="color: #a1a1aa; text-align: center; font-size: 13px; margin: 0 0 8px 0;">
            This code is valid for <strong style="color: #fbbf24;">10 minutes</strong>.
        </p>
        <p style="color: #71717a; text-align: center; font-size: 12px; margin: 0;">
            If you didn't create an account, you can safely ignore this email.
        </p>

        <!-- Footer -->
        <hr style="border: none; border-top: 1px solid #2d2d44; margin: 30px 0 20px 0;">
        <p style="color: #52525b; text-align: center; font-size: 11px; margin: 0;">
            &copy; {{ date('Y') }} StudentPortal. All rights reserved.
        </p>
    </div>
</body>
</html>
