<div class="overflow-x-auto">
    <table class="transactions-table">
        <thead class="transactions-thead">
            <tr>
                <th class="transactions-th">ID</th>
                <th class="transactions-th">Tanggal</th>
                <th class="transactions-th">Produk</th>
                <th class="transactions-th-right">Diskon</th>
                <th class="transactions-th-right">Total</th>
                <th class="transactions-th">Metode</th>
                <th class="transactions-th">Status</th>
                <th class="transactions-th-actions">Aksi</th>
            </tr>
        </thead>
        <tbody class="transactions-tbody">
            @forelse($transactions as $t)
                <tr class="transactions-tr">
                    <td class="transactions-td">
                        <div class="transaction-id">#{{ $t->id }}</div>
                    </td>
                    <td class="transactions-td">
                        <div class="transaction-date">{{ $t->created_at->format('Y-m-d H:i') }}</div>
                    </td>
                    <td class="transactions-td">
                        <div class="transaction-products">
                            @foreach($t->items as $item)
                                <div class="product-name">{{ $item->product_name ?? $item->product?->name ?? 'Produk dihapus' }}</div>
                            @endforeach
                        </div>
                    </td>
                    <td class="transactions-td text-right">
                        <div class="transaction-discount text-red-500 font-medium">
                            {{ $t->discount > 0 ? '- ' . rupiah($t->discount) : '-' }}
                        </div>
                    </td>
                    <td class="transactions-td text-right">
                        <div class="transaction-total">{{ rupiah($t->total_price) }}</div>
                    </td>
                    <td class="transactions-td">
                        <div class="transaction-method">
                            {{ $t->payment_method === 'ewallet' ? 'Qris' : ucfirst($t->payment_method) }}
                        </div>
                    </td>
                    <td class="transactions-td">
                        <span class="status-badge {{ $t->payment_status === 'paid' ? 'status-paid' : 'status-unpaid' }}">{{ $t->payment_status }}</span>
                    </td>
                    <td class="transactions-td text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button wire:click="viewTransaction({{ $t->id }})" class="view-btn">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat
                            </button>
                            <button type="button" onclick="confirmDeleteTransaction({{ $t->id }})" class="delete-btn">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="empty-transactions">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="pagination-wrapper">
    {{ $transactions->links() }}
</div>
