<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MunchGud - Login OTP</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #F8F6F0; margin: 0; padding: 40px 20px;">
    
    <div style="max-width: 480px; margin: 0 auto; background-color: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
        
        <!-- Header -->
        <div style="background-color: #1A3626; padding: 30px 40px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 1px;">MunchGud</h1>
            <p style="color: #8BA896; margin: 8px 0 0 0; font-size: 14px;">Snack Better, Live Better</p>
        </div>

        <!-- Body -->
        <div style="padding: 40px;">
            <h2 style="color: #1A3626; margin: 0 0 15px 0; font-size: 20px;">Verify your login</h2>
            <p style="color: #555555; font-size: 15px; line-height: 1.6; margin: 0 0 30px 0;">
                You recently requested to login to your MunchGud account. Here is your One-Time Password (OTP).
            </p>

            <div style="background-color: #F8F6F0; border-radius: 16px; padding: 25px; text-align: center; border: 1px dashed #1A362640;">
                <p style="color: #888888; font-size: 13px; text-transform: uppercase; letter-spacing: 2px; margin: 0 0 10px 0; font-weight: bold;">Your Verification Code</p>
                <div style="color: #1A3626; font-size: 42px; font-weight: 900; letter-spacing: 10px; font-family: monospace;">
                    {{ $otp }}
                </div>
            </div>

            <p style="color: #888888; font-size: 13px; line-height: 1.5; margin: 30px 0 0 0; text-align: center;">
                This code will expire in 10 minutes. If you didn't request this code, you can safely ignore this email.
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #F8F6F0; padding: 20px; text-align: center; border-top: 1px solid #EEEEEE;">
            <p style="color: #999999; font-size: 12px; margin: 0;">
                &copy; {{ date('Y') }} MunchGud. All rights reserved.
            </p>
        </div>

    </div>

</body>
</html>
