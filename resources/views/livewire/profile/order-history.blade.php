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
                <article class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm p-4 sm:p-5 flex flex-col md:flex-row gap-4 sm:gap-6" wire:key="order-history-{{ $order->id }}">
                    <div class="flex-1 space-y-3">
                        <div class="flex items-center justify-between text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">
                            <span class="font-mono bg-gray-100 dark:bg-gray-800 px-2 py-0.5 rounded">{{ $order->invoice_number ?? '#' . str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span>{{ $order->created_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                        <div>
                            <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-gray-100 leading-snug">
                                {{ $order->items->first()->product->name ?? 'Produk terhapus' }}
                                @if($order->items->count() > 1)
                                    <span class="text-sm font-normal text-gray-500">(+{{ $order->items->count() - 1 }} lainnya)</span>
                                @endif
                            </h2>
                            <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                                @foreach($order->items->take(1) as $item)
                                    <p>{{ $item->product->name ?? 'Deleted' }} (x{{ $item->quantity }})</p>
                                @endforeach
                            </div>
                            <div class="pt-2 font-bold text-sm sm:text-base text-emerald-600 dark:text-emerald-400">{{ rupiah($order->total_price) }}</div>
                        </div>
                        <div class="inline-flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-[10px] sm:text-xs font-semibold border {{ $order->status_class ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                {{ $order->status_label ?? ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="md:w-64 pt-4 md:pt-0 md:pl-6 border-t md:border-t-0 md:border-l border-gray-100 dark:border-gray-800 flex flex-col justify-between">
                        <div class="space-y-3">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">Info Pengiriman</p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2">
                                <div>
                                    <p class="text-[10px] text-gray-400 dark:text-gray-500">Penerima</p>
                                    <p class="text-xs font-medium text-gray-900 dark:text-gray-300 truncate">{{ $order->buyer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 dark:text-gray-500">Kontak</p>
                                    <p class="text-xs font-medium text-gray-900 dark:text-gray-300 truncate">{{ $order->buyer_contact ?? '-' }}</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-[10px] text-gray-400 dark:text-gray-500">Alamat</p>
                                @if($order->shipping_address === 'AMBIL DI TOKO')
                                    <div class="mt-0.5">
                                        <p class="text-xs font-medium text-gray-900 dark:text-gray-300 leading-snug">{{ \App\Models\Setting::get('shop_address') ?? 'Alamat Toko' }}</p>
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300 mt-1 border border-indigo-100 dark:border-indigo-800/50">
                                            Ambil di Toko
                                        </span>
                                    </div>
                                @else
                                    <p class="text-xs font-medium text-gray-900 dark:text-gray-300 leading-snug break-words">{{ $order->shipping_address ?? 'Belum diisi' }}</p>
                                @endif
                            </div>
                            
                            <div>
                                <p class="text-[10px] text-gray-400 dark:text-gray-500">Metode Bayar</p>
                                <p class="text-xs font-medium text-gray-900 dark:text-gray-300">
                                    @if($order->payment_method === 'cash')
                                        @if($order->shipping_address === 'AMBIL DI TOKO')
                                            Bayar di Kasir
                                        @else
                                            COD
                                        @endif
                                    @else
                                        Non-Tunai
                                    @endif
                                </p>
                            </div>
                            
                            @if ($order->notes)
                                <div>
                                    <p class="text-[10px] text-gray-400 dark:text-gray-500">Catatan</p>
                                    <p class="text-xs text-gray-700 dark:text-gray-400 italic truncate">{{ $order->notes }}</p>
                                </div>
                            @endif
                        </div>
                        
                        @if($order->status !== 'pending')
                        <button 
                            x-data 
                            x-on:click="Livewire.dispatch('open-receipt-modal', { orderId: {{ $order->id }} })"
                            class="w-full mt-4 inline-flex items-center justify-center rounded-lg bg-indigo-50 border border-indigo-100 dark:bg-gray-800 dark:border-gray-700 px-3 py-2 text-xs font-semibold text-indigo-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-gray-700 transition-all active:scale-95"
                        >
                            <svg class="w-3.5 h-3.5 mr-1.5 text-indigo-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Lihat Struk
                        </button>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <div>
            {{ $orders->links() }}
        </div>
    @endif
</div>
