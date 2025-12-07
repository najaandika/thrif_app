<div class="profile-section" wire:poll.5s>
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-xs font-semibold tracking-[0.2em] text-gray-500 uppercase">Riwayat Pembelian</p>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Semua transaksi kamu terekam di sini.</h3>
        </div>
        <div class="flex items-center gap-2 text-sm">
            <label for="history-status" class="text-gray-500">Filter status</label>
            <select wire:model.live="status" id="history-status" class="rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 text-sm">
                @foreach ($statusOptions as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($orders->isEmpty())
        <div class="rounded-2xl border border-dashed border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 p-8 text-center text-sm text-gray-500 dark:text-gray-400">
            Belum ada transaksi. Mulai belanja dari landing page untuk melihat riwayat di sini.
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                <article class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 overflow-hidden shadow-sm" wire:key="order-history-{{ $order->id }}">
                    <div class="p-5 flex flex-col lg:flex-row gap-4">
                        <div class="flex-1 space-y-2">
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span>{{ $order->created_at->translatedFormat('d M Y H:i') }}</span>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ $order->product->name ?? 'Produk terhapus' }}
                            </h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Qty {{ $order->quantity }} · {{ rupiah($order->total_price) }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Status: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ ucfirst($order->status) }}</span>
                            </p>
                            @if ($order->notes)
                                <p class="text-sm text-gray-500 dark:text-gray-400">Catatan: {{ $order->notes }}</p>
                            @endif
                        </div>
                        <div class="lg:w-64 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/60 p-4 text-sm text-gray-600 dark:text-gray-300">
                            <p class="font-semibold text-gray-900 dark:text-gray-100 mb-3">Detail Pengiriman</p>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Nama Penerima</p>
                                    <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->buyer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Kontak</p>
                                    <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->buyer_contact ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Alamat</p>
                                    <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->shipping_address ?? 'Belum diisi' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Metode Pembayaran</p>
                                    <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->payment_method === 'cash' ? 'Cash On Delivery' : ucfirst($order->payment_method) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div>
            {{ $orders->links() }}
        </div>
    @endif
</div>
