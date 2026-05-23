<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body style="font-family: sans-serif; background-color: #FAF7F0; color: #1A1A1A; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-top: 4px solid #1B4332;">
        <h2 style="color: #1B4332;">Thank you for your order!</h2>
        <p>Hi {{ $order->user->name ?? 'Guest' }},</p>
        <p>We've received your order <strong>#{{ $order->order_number }}</strong> and are getting it ready to ship.</p>
        
        <h3>Order Summary</h3>
        <table style="width: 100%; border-collapse: collapse;">
            @foreach($order->items as $item)
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $item->product_name }} - {{ $item->variant_name }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">x{{ $item->quantity }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee; text-align: right;">₹{{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </table>
        
        <div style="text-align: right; margin-top: 20px;">
            <p>Subtotal: ₹{{ number_format($order->subtotal, 2) }}</p>
            @if($order->discount_amount > 0)
            <p>Discount: -₹{{ number_format($order->discount_amount, 2) }}</p>
            @endif
            <p>Shipping: ₹{{ number_format($order->shipping_amount, 2) }}</p>
            <p>Tax: ₹{{ number_format($order->tax_amount, 2) }}</p>
            <h3>Total: ₹{{ number_format($order->total, 2) }}</h3>
        </div>
        
        <div style="margin-top: 30px;">
            <a href="{{ url('/') }}" style="background-color: #E07B2A; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Track Order</a>
        </div>
        
        <p style="margin-top: 30px; font-size: 0.9em; color: #666;">Thank you for choosing MunchGud.</p>
    </div>
</body>
</html>
