<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #050811; color: #ffffff; padding: 40px; }
        .box { border: 1px solid #00f2ff; padding: 30px; background: rgba(15, 23, 42, 0.9); border-radius: 15px; text-align: center; }
        .badge { display: inline-block; padding: 5px 15px; background: #bc13fe; border-radius: 20px; font-weight: bold; margin-bottom: 20px; }
        .footer { font-size: 11px; color: #64748b; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="box">
        <div class="badge">{{ $order->payment_method == 'card' ? 'PAYMENT_RECEIVED' : 'ORDER_LOGGED' }}</div>
        <h2 style="color: #00f2ff; font-family: 'Orbitron', sans-serif;">TRANSACTION_SUMMARY</h2>
        <p>Greetings, {{ $order->user->name }}.</p>
        <p>Thank you for your {{ $order->payment_method == 'card' ? 'payment' : 'order' }} via {{ strtoupper($order->payment_method) }}. Your requested gear modules are now assigned to your profile log.</p>
        
        <p>Order ID: <strong>#{{ $order->id }}</strong></p>
        <p>Total Credits: <strong>₹ {{ number_format($order->total_amount, 2) }}</strong></p>
        
        <p>Please find your encrypted billing invoice attached to this transmission.</p>
        
        <p>Safe travels in the Nexus.</p>
        
        <div class="footer">
            VENDOMART_CORE_PORTAL // SECURE_UPLINK_TERMINATED
        </div>
    </div>
</body>
</html>
