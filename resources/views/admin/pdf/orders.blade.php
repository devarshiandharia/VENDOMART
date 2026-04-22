<!DOCTYPE html>
<html>
<head>
    <title>Orders Report</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #777; }
        .text-right { text-align: right; }
        .status-badge { padding: 3px 8px; border-radius: 4px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>VENDOMART - COMMAND CENTER</h1>
        <h2>All Orders Report</h2>
        <p>Generated on: {{ date('F d, Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Destination</th>
                <th>Product(s)</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>
                    {{ $order->user->name }}<br>
                    <small>{{ $order->user->email }}</small><br>
                    <small>{{ $order->phone }}</small>
                </td>
                <td>
                    <small>{{ $order->address }}</small><br>
                    <strong>{{ $order->city }}, {{ $order->state }}</strong>
                </td>
                <td>
                    @foreach($order->items as $item)
                        {{ $item->product->name }} (x{{ $item->quantity }})<br>
                    @endforeach
                </td>
                <td>{{ $order->status }}</td>
                <td class="text-right">&#8377; {{ number_format($order->total_amount, 2) }}</td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">TOTAL ARCHIVE VALUE:</th>
                <th class="text-right">&#8377; {{ number_format($orders->sum('total_amount'), 2) }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Vendomart Systems - Confidential Data - {{ date('Y') }}
    </div>
</body>
</html>
