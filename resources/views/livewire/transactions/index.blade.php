

<div class="py-12">
    <div>
        @if (session()->has('message'))
            <x-alert :message="session('message')" type="success" />
        @endif

        <div class="flex flex-row gap-6">
            <x-sidebar />

            <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-8">
                        <div class="mb-6 flex flex-col lg:flex-row gap-4 lg:items-center justify-between">
                            <div class="flex flex-col sm:flex-row gap-4 flex-1">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        wire:model.live="search"
                                        type="text"
                                        placeholder="Cari ID / metode / status"
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200 shadow-sm hover:shadow-md"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="transactions-table">
                                <thead class="transactions-thead">
                                    <tr>
                                        <th class="transactions-th">ID</th>
                                        <th class="transactions-th">Tanggal</th>
                                        <th class="transactions-th">Produk</th>
                                        <th class="transactions-th-right">Qty</th>
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
                                                        <div class="product-name">{{ $item->product->name ?? 'N/A' }}</div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="transactions-td text-right">
                                                <span class="transaction-qty">{{ $t->total_qty ?? '-' }}</span>
                                            </td>
                                            <td class="transactions-td text-right">
                                                <div class="transaction-discount text-red-500 font-medium">
                                                    {{ $t->discount > 0 ? '- Rp ' . number_format($t->discount, 0, ',', '.') : '-' }}
                                                </div>
                                            </td>
                                            <td class="transactions-td text-right">
                                                <div class="transaction-total">Rp {{ number_format($t->total_price, 0, ',', '.') }}</div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Detail Modal -->
    @if($showModal && $selectedTransaction)
        <div class="modal-overlay" wire:click="closeModal">
            <div class="modal-container" wire:click.stop>
                <div class="modal-header">
                    <h3 class="modal-title">Detail Transaksi #{{ $selectedTransaction->id }}</h3>
                    <button wire:click="closeModal" class="modal-close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Transaction Info -->
                    <div class="receipt-section">
                        <div class="receipt-row">
                            <span class="receipt-label">Tanggal:</span>
                            <span class="receipt-value">{{ $selectedTransaction->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Metode Pembayaran:</span>
                            <span class="receipt-value">
                                {{ $selectedTransaction->payment_method === 'ewallet' ? 'Qris' : ucfirst($selectedTransaction->payment_method) }}
                            </span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Status:</span>
                            <span class="status-badge {{ $selectedTransaction->payment_status === 'paid' ? 'status-paid' : 'status-unpaid' }}">
                                {{ $selectedTransaction->payment_status }}
                            </span>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="receipt-section">
                        <h4 class="receipt-section-title">Item Produk</h4>
                        <div class="receipt-items">
                            @foreach($selectedTransaction->items as $item)
                                <div class="receipt-item">
                                    <div class="receipt-item-info">
                                        <div class="receipt-item-name">{{ $item->product->name ?? 'Produk tidak tersedia' }}</div>
                                        <div class="receipt-item-detail">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="receipt-item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="receipt-section receipt-summary">
                        <div class="receipt-row">
                            <span class="receipt-label">Total Qty:</span>
                            <span class="receipt-value font-semibold">{{ $selectedTransaction->total_qty }}</span>
                        </div>
                        @if($selectedTransaction->discount > 0)
                            <div class="receipt-row">
                                <span class="receipt-label">Diskon:</span>
                                <span class="receipt-value text-red-500 font-medium">- Rp {{ number_format($selectedTransaction->discount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="receipt-row receipt-total">
                            <span class="receipt-label">Total Harga:</span>
                            <span class="receipt-value">Rp {{ number_format($selectedTransaction->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($selectedTransaction->notes)
                        <div class="receipt-section">
                            <h4 class="receipt-section-title">Catatan</h4>
                            <p class="receipt-notes">{{ $selectedTransaction->notes }}</p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button wire:click="closeModal" class="btn-close-modal">Tutup</button>
                </div>
            </div>
        </div>
    @endif

    <script>
        function confirmDeleteTransaction(id) {
            if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                @this.call('delete', id);
            }
        }
    </script>
</div>
