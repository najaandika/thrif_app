<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Orders</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cccccc; padding: 6px 8px; }
        th { background-color: #f3f4f6; text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
<h1>Laporan Orders</h1>
<p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
<table>
    <thead>
    <tr>
        <th class="text-center">No. Invoice</th>
        <th>Produk</th>
        <th>Pembeli</th>
        <th>Kontak</th>
        <th class="text-center">Qty</th>
        <th class="text-right">Total</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td class="text-center">{{ $order->invoice_number }}</td>
            <td>
                @foreach($order->items as $item)
                    <div>- {{ $item->product->name ?? '-' }} (x{{ $item->quantity }})</div>
                @endforeach
            </td>
            <td>{{ $order->buyer_name }}</td>
            <td>{{ $order->buyer_contact ?: '-' }}</td>
            <td class="text-center">{{ $order->items->sum('quantity') }}</td>
            <td class="text-right">{{ rupiah($order->total_price) }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

