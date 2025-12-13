<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderExportController extends Controller
{
    public function excel(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');

        $orders = $this->getOrders($search, $status);

        $headers = [
            'ID Order',
            'Type', // New
            'Produk',
            'Nama Pembeli',
            'Kontak Pembeli',
            'Total Qty',
            'Total Harga',
            'Status',
            'Terakhir Diupdate',
        ];

        $output = fopen('php://temp', 'r+');
        fputcsv($output, $headers);

        foreach ($orders as $order) {
            // Join product names
            $productNames = $order->items->map(fn($item) => $item->product->name ?? '-')->join(', ');
            $totalQty = $order->items->sum('quantity');

            fputcsv($output, [
                sprintf('#%04d', $order->id),
                ucfirst($order->type),
                $productNames,
                $order->buyer_name,
                $order->buyer_contact,
                $totalQty,
                $order->total_price,
                $order->status,
                optional($order->updated_at)->toDateTimeString(),
            ]);
        }

        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);

        // Bersihkan output buffer agar tidak ada spasi/error yang ikut terdownload
        if (ob_get_length()) ob_end_clean();

        $filename = 'orders-' . date('Y-m-d-H-i') . '.csv';

        // Tambahkan BOM untuk Excel
        return response("\xEF\xBB\xBF" . $csvContent)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');

        $orders = $this->getOrders($search, $status);

        // Bersihkan output buffer
        if (ob_get_length()) ob_end_clean();

        $pdf = Pdf::loadView('exports.orders-pdf', [
            'orders' => $orders,
        ]);

        return $pdf->download('orders-' . date('Y-m-d-H-i') . '.pdf');
    }

    private function getOrders($search, $status)
    {
        return Order::with('items.product')
            ->where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                $term = '%' . $search . '%';
                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('buyer_name', 'like', $term)
                        ->orWhere('buyer_contact', 'like', $term)
                        ->orWhereHas('items.product', function ($productQuery) use ($term) {
                            $productQuery->where('name', 'like', $term);
                        });
                });
            })
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();
    }
}
