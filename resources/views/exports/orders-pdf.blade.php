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
    </style>
</head>
<body>
<h1>Laporan Orders</h1>
<p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Pembeli</th>
        <th>Kontak</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Status</th>
        <th>Update</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $order->product->name ?? '-' }}</td>
            <td>{{ $order->buyer_name }}</td>
            <td>{{ $order->buyer_contact ?: '-' }}</td>
            <td>{{ $order->quantity }}</td>
            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ $order->updated_at?->format('d/m/Y H:i') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
