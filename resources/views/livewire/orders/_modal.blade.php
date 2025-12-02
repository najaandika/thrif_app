@if($showModal && $selectedOrder)
    <div class="modal-overlay" wire:click="closeModal">
        <div class="modal-container" wire:click.stop>
            <div class="modal-header">
                <h3 class="modal-title">Detail Order #{{ str_pad($selectedOrder->id, 4, '0', STR_PAD_LEFT) }}</h3>
                <button wire:click="closeModal" class="modal-close">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <div class="receipt-section">
                    <div class="receipt-row">
                        <span class="receipt-label">Tanggal:</span>
                        <span class="receipt-value">{{ $selectedOrder->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Status:</span>
                        <span class="status-badge {{ $selectedOrder->status === 'paid' ? 'status-paid' : ($selectedOrder->status === 'pending' ? 'status-unpaid' : 'status-badge-info') }}">
                            {{ ucfirst($selectedOrder->status) }}
                        </span>
                    </div>
                </div>

                <div class="receipt-section">
                    <h4 class="receipt-section-title">Informasi Pembeli</h4>
                    <div class="receipt-row">
                        <span class="receipt-label">Nama:</span>
                        <span class="receipt-value">{{ $selectedOrder->buyer_name }}</span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Kontak:</span>
                        <span class="receipt-value">{{ $selectedOrder->buyer_contact ?: '-' }}</span>
                    </div>
                    <div class="receipt-row items-start">
                        <span class="receipt-label pr-4">Alamat:</span>
                        <p class="receipt-value max-w-sm text-left leading-relaxed">
                            {{ $selectedOrder->shipping_address ?: '-' }}
                        </p>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Pembayaran:</span>
                        <span class="receipt-value">{{ $selectedOrder->payment_method === 'cash' ? 'Cash On Delivery' : ucfirst($selectedOrder->payment_method ?? '-') }}</span>
                    </div>
                </div>

                <div class="receipt-section">
                    <h4 class="receipt-section-title">Item Produk</h4>
                    <div class="receipt-items">
                        <div class="receipt-item">
                            <div class="receipt-item-info">
                                <div class="receipt-item-name">{{ $selectedOrder->product->name ?? 'Produk tidak tersedia' }}</div>
                                <div class="receipt-item-detail">{{ $selectedOrder->quantity }} x Rp {{ number_format($selectedOrder->product->price ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="receipt-item-subtotal">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="receipt-section receipt-summary">
                    <div class="receipt-row">
                        <span class="receipt-label">Total Qty:</span>
                        <span class="receipt-value font-semibold">{{ $selectedOrder->quantity }}</span>
                    </div>
                    <div class="receipt-row receipt-total">
                        <span class="receipt-label">Total Harga:</span>
                        <span class="receipt-value">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button wire:click="closeModal" class="btn-close-modal">Tutup</button>
            </div>
        </div>
    </div>
@endif
