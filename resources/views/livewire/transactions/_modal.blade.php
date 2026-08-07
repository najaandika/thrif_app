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
                <div class="receipt-section">
                    <div class="receipt-row">
                        <span class="receipt-label">Tanggal:</span>
                        <span class="receipt-value">{{ $selectedTransaction->created_at->format('d M Y, H:i') }}</span>
                    </div>

                    <div class="receipt-row">
                        <span class="receipt-label">Status:</span>
                        <span class="status-badge {{ $selectedTransaction->payment_status === 'paid' ? 'status-paid' : 'status-unpaid' }}">
                            {{ $selectedTransaction->payment_status }}
                        </span>
                    </div>
                </div>

                <div class="receipt-section">
                    <h4 class="receipt-section-title">Item Produk</h4>
                    <div class="receipt-items">
                        @foreach($selectedTransaction->items as $item)
                            <div class="receipt-item">
                                <div class="receipt-item-info">
                                    <div class="receipt-item-name">{{ $item->product_name ?? $item->product?->name ?? 'Produk dihapus' }}</div>
                                    <div class="receipt-item-detail">
                                        @php
                                            $originalPrice = $item->product?->price ?? $item->price;
                                            $isDiscounted = $item->product && $item->price < $originalPrice;
                                            $discountPercent = $isDiscounted ? round((($originalPrice - $item->price) / $originalPrice) * 100) : 0;
                                        @endphp

                                        @if($isDiscounted)
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="text-xs bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold">-{{ $discountPercent }}%</span>
                                                <span class="text-xs text-gray-400 line-through">{{ rupiah($originalPrice) }}</span>
                                                <span class="text-red-600 font-bold">{{ rupiah($item->price) }}</span>
                                            </div>
                                            <div class="text-[10px] text-gray-500 mt-0.5">{{ $item->qty }} x {{ rupiah($item->price) }}</div>
                                        @else
                                            {{ $item->qty }} x {{ rupiah($item->price) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="receipt-item-subtotal font-semibold">{{ rupiah($item->subtotal) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="receipt-section receipt-summary">

                    @if($selectedTransaction->discount > 0)
                        <div class="receipt-row">
                            <span class="receipt-label">Diskon:</span>
                            <span class="receipt-value text-red-500 font-medium">- {{ rupiah($selectedTransaction->discount) }}</span>
                        </div>
                    @endif
                    <div class="receipt-row receipt-total">
                        <span class="receipt-label">Total Harga:</span>
                        <span class="receipt-value">{{ rupiah($selectedTransaction->total_price) }}</span>
                    </div>


                    
                    @if($selectedTransaction->payment_method === 'cash')
                        <div class="receipt-row">
                            <span class="receipt-label">Uang Diterima:</span>
                            <span class="receipt-value">{{ rupiah($selectedTransaction->amount_received) }}</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Kembalian:</span>
                            <span class="receipt-value text-green-600 font-medium">{{ rupiah($selectedTransaction->change) }}</span>
                        </div>
                    @endif

                    <div class="receipt-row" style="margin-top: 8px; padding-top: 8px; border-top: 1px dashed #eee;">
                        <span class="receipt-label">Metode Bayar:</span>
                        <span class="receipt-value font-bold uppercase">
                            {{ $selectedTransaction->payment_method === 'ewallet' ? 'Qris' : ucfirst($selectedTransaction->payment_method) }}
                        </span>
                    </div>
                </div>

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

