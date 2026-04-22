<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #050811; color: #ffffff; padding: 40px; }
        .box { border: 1px solid #00f2ff; padding: 30px; background: rgba(15, 23, 42, 0.9); border-radius: 15px; text-align: center; }
        .otp { font-size: 32px; font-weight: bold; color: #00f2ff; letter-spacing: 10px; margin: 20px 0; padding: 10px; border: 1px dashed rgba(0, 242, 255, 0.5); }
        .footer { font-size: 11px; color: #64748b; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="box">
        <h2 style="color: #bc13fe; font-family: 'Orbitron', sans-serif;">SECURE_AUTHENTICATION</h2>
        <p>Greetings, {{ $name }}.</p>
        <p>A secure authorization request has been initiated. Use the following digital key to synchronize your action:</p>
        
        <div class="otp">{{ $otp }}</div>
        
        <p>This key will expire in 10 minutes. If you did not initiate this request, terminate connection immediately.</p>
        
        <div class="footer">
            VENDOMART_GEAR_PORTAL // SECURE_UPLINK_ESTABLISHED
        </div>
    </div>
</body>
</html>
