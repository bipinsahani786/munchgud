<!DOCTYPE html>
<html>
<head>
    <title>Did you forget something?</title>
</head>
<body style="font-family: sans-serif; background-color: #FAF7F0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-top: 4px solid #1B4332;">
        <h2 style="color: #1B4332;">You left something behind!</h2>
        <p>We noticed you left some delicious snacks in your cart.</p>
        
        @if($discountCode)
            <div style="background-color: #E07B2A; color: white; padding: 15px; text-align: center; margin: 20px 0;">
                Use code <strong>{{ $discountCode }}</strong> for a special discount!
            </div>
        @endif
        
        <div style="margin-top: 30px; text-align: center;">
            <a href="{{ url('/cart') }}" style="background-color: #1B4332; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;">Return to Cart</a>
        </div>
    </div>
</body>
</html>
