<!DOCTYPE html>
<html>
<head>
    <title>New Order Alert</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>New Order Received!</h2>
    <p>Order <strong>#{{ $order->order_number }}</strong> was just placed.</p>
    <p>Total: ₹{{ number_format($order->total, 2) }}</p>
    <p>Payment Status: {{ ucfirst($order->payment_status) }}</p>
    <a href="{{ url('/admin/orders/' . $order->id) }}">View Order</a>
</body>
</html>
