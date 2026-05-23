<!DOCTYPE html>
<html>
<head>
    <title>Order Status Update</title>
</head>
<body style="font-family: sans-serif; background-color: #FAF7F0; color: #1A1A1A; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-top: 4px solid #1B4332;">
        <h2 style="color: #1B4332;">Order Status Update</h2>
        <p>Hi {{ $order->user->name ?? 'Guest' }},</p>
        <p>Your order <strong>#{{ $order->order_number }}</strong> status has been updated to: <strong>{{ ucfirst($order->status) }}</strong>.</p>
        
        @if($order->tracking_number)
            <p><strong>Tracking Number:</strong> {{ $order->tracking_number }}</p>
            @if($order->courier_name)
                <p><strong>Courier:</strong> {{ $order->courier_name }}</p>
            @endif
        @endif
        
        <p style="margin-top: 30px; font-size: 0.9em; color: #666;">Thank you for choosing MunchGud.</p>
    </div>
</body>
</html>
