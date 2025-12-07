<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cccccc; padding: 6px 8px; }
        th { background-color: #f3f4f6; text-align: left; }
    </style>
</head>
<body>
<h1>Laporan Transaksi</h1>
<p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Produk</th>
        <th>Total Qty</th>
        <th>Diskon</th>
        <th>Total</th>
        <th>Metode</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $t)
        <tr>
            <td>#{{ $t->id }}</td>
            <td>{{ $t->created_at?->format('d/m/Y H:i') }}</td>
            <td>
                @foreach($t->items as $item)
                    <div>{{ $item->product->name ?? 'N/A' }}</div>
                @endforeach
            </td>
            <td>{{ $t->total_qty }}</td>
            <td>{{ $t->discount > 0 ? rupiah($t->discount) : '-' }}</td>
            <td>{{ rupiah($t->total_price) }}</td>
            <td>{{ $t->payment_method === 'ewallet' ? 'Qris' : ucfirst($t->payment_method) }}</td>
            <td>{{ $t->payment_status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
