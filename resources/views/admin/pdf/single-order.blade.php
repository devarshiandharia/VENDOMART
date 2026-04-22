<!DOCTYPE html>
<html>
<head>
    <title>Order Detail #{{ $order->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 13px; color: #333; line-height: 1.6; }
        .invoice-box { padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .header { display: table; width: 100%; margin-bottom: 40px; }
        .logo { font-size: 24px; font-weight: bold; color: #00f2ff; text-transform: uppercase; }
        .info { display: table; width: 100%; margin-bottom: 20px; }
        .info-col { display: table-cell; width: 50%; vertical-align: top; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border-bottom: 1px solid #eee; padding: 12px; text-align: left; }
        th { background-color: #fafafa; font-weight: bold; }
        .total-section { margin-top: 30px; text-align: right; }
        .total-amount { font-size: 18px; font-weight: bold; color: #333; }
        .footer { text-align: center; margin-top: 50px; font-size: 10px; color: #aaa; }
        .status { padding: 5px 10px; background: #eee; border-radius: 4px; display: inline-block; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div style="display: table-cell;">
                <div class="logo">Vendomart</div>
                <p>Nexus Point, Sector 7<br>Neo City, 400001</p>
            </div>
            <div style="display: table-cell; text-align: right;">
                <h2 style="margin:0;">ORDER INVOICE</h2>
                <p>Order ID: #{{ $order->id }}<br>Date: {{ $order->created_at->format('F d, Y') }}</p>
            </div>
        </div>

        <div class="info">
            <div class="info-col">
                <strong>Customer Information</strong>
                <p>
                    Name: {{ $order->user->name }}<br>
                    Email: {{ $order->user->email }}<br>
                    Phone: {{ $order->phone }}
                </p>
            </div>
            <div class="info-col" style="text-align: right;">
                <strong>Shipping Address</strong>
                <p>{{ $order->address }}<br>{{ $order->city }}, {{ $order->state }} - {{ $order->zip_code }}</p>
            </div>
        </div>

        <div class="info">
            <div class="info-col">
                <strong>Payment Information</strong>
                <p>
                    Method: {{ $order->payment_method == 'card' ? 'Payment by Card' : 'Cash on Delivery' }}<br>
                    Status: 
                    @if($order->payment_method == 'card')
                        PAID (Success)
                    @else
                        {{ $order->status == 'Delivered' ? 'PAID' : 'PENDING' }}
                    @endif
                </p>
            </div>
            <div class="info-col" style="text-align: right;">
                <strong>Order Status</strong><br>
                <span class="status">{{ strtoupper($order->status) }}</span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>&#8377; {{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>&#8377; {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <p>Subtotal: &#8377; {{ number_format($order->total_amount, 2) }}</p>
            <p class="total-amount">TOTAL: &#8377; {{ number_format($order->total_amount, 2) }}</p>
        </div>

        <div class="footer">
            Thank you for choosing Vendomart. Your digital transaction is complete.<br>
            © {{ date('Y') }} Vendomart Gaming Portal
        </div>
    </div>
</body>
</html>
