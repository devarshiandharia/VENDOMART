<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #00f2ff; border-radius: 10px; background: #050811; color: #fff; }
        .header { border-bottom: 2px solid #00f2ff; padding-bottom: 10px; margin-bottom: 20px; }
        .label { color: #00f2ff; font-weight: bold; text-transform: uppercase; font-size: 12px; }
        .content { background: rgba(255,255,255,0.05); padding: 15px; border-radius: 5px; }
        .footer { margin-top: 30px; font-size: 11px; color: #64748b; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #00f2ff; margin: 0;">INCOMING_SIGNAL</h2>
        </div>
        
        <p><span class="label">OPERATOR_NAME:</span><br>{{ $name }}</p>
        <p><span class="label">COMMS_LINK:</span><br>{{ $email }}</p>
        <p><span class="label">SUBJECT:</span><br>{{ $subject }}</p>
        
        <div class="content">
            <span class="label">TRANSMISSION_CONTENT:</span><br>
            <p>{{ $user_message }}</p>
        </div>

        <div class="footer">
            VENDOMART_GEAR_PORTAL - AUTO_LOG_GENERATED
        </div>
    </div>
</body>
</html>
