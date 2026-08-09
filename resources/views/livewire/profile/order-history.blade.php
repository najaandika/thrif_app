<div class="space-y-5" wire:poll.5s>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Riwayat Pembelian</p>
            <h3 class="mt-1 text-xl font-extrabold tracking-[-0.035em] text-slate-950">Semua transaksi kamu terekam di sini.</h3>
        </div>
        <div class="w-full sm:w-64">
            <label for="history-status" class="mb-2 block text-[10px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Filter status</label>
            <div class="relative">
                <select wire:model.live="status" id="history-status" name="history_status" class="h-12 w-full appearance-none rounded-2xl border border-slate-200 bg-white px-4 pr-11 text-sm font-extrabold text-slate-800 shadow-sm outline-none transition hover:border-slate-300 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10">
                    @foreach ($statusOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
        </div>
    </div>

    @if ($orders->isEmpty())
        <div class="rounded-[1.75rem] border border-dashed border-slate-200 bg-slate-50 p-8 text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6M9 9h6M9 13h3M5 3h14v18l-7-3-7 3V3z" />
                </svg>
            </div>
            <h4 class="mt-5 text-2xl font-extrabold tracking-[-0.04em] text-slate-950">Belum ada order.</h4>
            <p class="mx-auto mt-2 max-w-sm text-sm font-medium leading-7 text-slate-600">Mulai pilih item thrift dulu, nanti status dan detail transaksinya muncul di sini.</p>
            <a href="{{ route('landing.products.index') }}" class="profile-primary-btn mt-5">Buka katalog</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                <article class="flex flex-col gap-4 rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 hover:shadow-[0_18px_50px_rgba(15,23,42,0.07)] sm:gap-6 sm:p-5 md:flex-row" wire:key="order-history-{{ $order->id }}">
                    <div class="flex-1 space-y-3">
                        <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400 sm:text-xs">
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 font-mono">{{ $order->invoice_number ?? '#' . str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span>{{ $order->created_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                        <div>
                            <h2 class="text-base font-extrabold leading-snug tracking-[-0.02em] text-slate-950 sm:text-lg">
                                {{ $order->items->first()->product->name ?? 'Produk terhapus' }}
                                @if($order->items->count() > 1)
                                    <span class="text-sm font-semibold text-slate-500">(+{{ $order->items->count() - 1 }} lainnya)</span>
                                @endif
                            </h2>
                            <div class="mt-1 text-xs font-medium text-slate-500 sm:text-sm">
                                @foreach($order->items->take(1) as $item)
                                    <p>{{ $item->product->name ?? 'Deleted' }} (x{{ $item->quantity }})</p>
                                @endforeach
                            </div>
                            <div class="pt-2 text-sm font-extrabold text-emerald-700 sm:text-base">{{ rupiah($order->total_price) }}</div>
                        </div>
                        <div class="inline-flex items-center gap-2">
                            <span class="rounded-full border px-3 py-1 text-[10px] font-extrabold sm:text-xs {{ $order->status_class ?? 'bg-slate-100 text-slate-800 border-slate-200' }}">
                                {{ $order->status_label ?? ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col justify-between border-t border-slate-100 pt-4 md:w-64 md:border-l md:border-t-0 md:pl-6 md:pt-0">
                        <div class="space-y-3">
                            <p class="mb-2 text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Info Pengiriman</p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-1 gap-2">
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Penerima</p>
                                    <p class="truncate text-xs font-bold text-slate-950">{{ $order->buyer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Kontak</p>
                                    <p class="truncate text-xs font-bold text-slate-950">{{ $order->buyer_contact ?? '-' }}</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Alamat</p>
                                @if($order->shipping_address === 'AMBIL DI TOKO')
                                    <div class="mt-0.5">
                                        <p class="text-xs font-bold leading-snug text-slate-950">{{ \App\Models\Setting::get('shop_address') ?? 'Alamat Toko' }}</p>
                                        <span class="mt-1 inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2 py-0.5 text-[9px] font-bold text-slate-700">
                                            Ambil di Toko
                                        </span>
                                    </div>
                                @else
                                    <p class="break-words text-xs font-bold leading-snug text-slate-950">{{ $order->shipping_address ?? 'Belum diisi' }}</p>
                                @endif
                            </div>
                            
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Metode Bayar</p>
                                <p class="text-xs font-bold text-slate-950">
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
                                    <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Catatan</p>
                                    <p class="truncate text-xs font-medium italic text-slate-600">{{ $order->notes }}</p>
                                </div>
                            @endif
                        </div>
                        
                        @if($order->status !== 'pending')
                        <button 
                            x-data 
                            x-on:click="Livewire.dispatch('open-receipt-modal', { orderId: {{ $order->id }} })"
                            class="mt-4 inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-extrabold text-slate-700 transition hover:bg-white hover:text-slate-950 active:scale-95"
                        >
                            <svg class="mr-1.5 h-3.5 w-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
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

