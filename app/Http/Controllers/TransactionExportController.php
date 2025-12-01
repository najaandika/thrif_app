<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionExportController extends Controller
{
    public function excel(Request $request)
    {
        $search = $request->input('search');

        $transactions = $this->getTransactions($search);

        $headers = [
            'ID Transaksi',
            'Tanggal',
            'Produk',
            'Total Qty',
            'Diskon',
            'Total Harga',
            'Metode',
            'Status Pembayaran',
        ];

        $output = fopen('php://temp', 'r+');
        fputcsv($output, $headers);

        foreach ($transactions as $transaction) {
            $productNames = $transaction->items->map(function ($item) {
                return optional($item->product)->name ?? 'N/A';
            })->implode(' / ');

            fputcsv($output, [
                '#' . $transaction->id,
                optional($transaction->created_at)->toDateTimeString(),
                $productNames,
                $transaction->total_qty,
                $transaction->discount,
                $transaction->total_price,
                $transaction->payment_method === 'ewallet' ? 'Qris' : ucfirst($transaction->payment_method),
                $transaction->payment_status,
            ]);
        }

        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);

        if (ob_get_length()) {
            ob_end_clean();
        }

        $filename = 'transactions-' . date('Y-m-d-H-i') . '.csv';

        return response("\xEF\xBB\xBF" . $csvContent)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function pdf(Request $request)
    {
        $search = $request->input('search');

        $transactions = $this->getTransactions($search);

        if (ob_get_length()) {
            ob_end_clean();
        }

        $pdf = Pdf::loadView('exports.transactions-pdf', [
            'transactions' => $transactions,
        ]);

        return $pdf->download('transactions-' . date('Y-m-d-H-i') . '.pdf');
    }

    private function getTransactions(?string $search)
    {
        return Transaction::with(['items.product'])
            ->when($search, function ($query) use ($search) {
                $term = '%' . $search . '%';
                $query->where(function ($q) use ($term) {
                    $q->where('id', 'like', $term)
                      ->orWhere('payment_method', 'like', $term)
                      ->orWhere('payment_status', 'like', $term);
                });
            })
            ->latest()
            ->get();
    }
}
