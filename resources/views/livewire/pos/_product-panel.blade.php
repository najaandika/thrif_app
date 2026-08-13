<section class="space-y-5">
    <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-xl font-black text-slate-950">Pilih produk</h2>
                <p class="mt-1 text-sm font-semibold text-slate-500">Klik item untuk masuk ke keranjang transaksi.</p>
            </div>

            <div class="relative w-full lg:max-w-md">
                <label for="search" class="sr-only">Cari produk POS</label>
                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.1-5.15a6.25 6.25 0 1 1-12.5 0 6.25 6.25 0 0 1 12.5 0Z" />
                </svg>
                <input
                    type="search"
                    id="search"
                    name="search"
                    wire:model.live.debounce.300ms="search"
                    class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm font-bold text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:bg-white focus:ring-4 focus:ring-slate-100"
                    placeholder="Cari nama, kategori, atau kondisi"
                    autofocus
                >
            </div>
        </div>
    </div>

    @if($loadProducts)
        <div class="rounded-[1.75rem] border border-slate-200 bg-white p-4 shadow-[0_20px_70px_rgba(15,23,42,0.06)] sm:p-5">
            <div class="mb-4 flex items-center justify-between gap-3">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Produk ready</p>
                <p class="text-sm font-extrabold text-slate-500">{{ $products->count() }} item</p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5">
                @forelse ($products as $product)
                    <button
                        type="button"
                        wire:click="addToCart({{ $product->id }})"
                        wire:loading.attr="disabled"
                        wire:target="addToCart({{ $product->id }})"
                        class="group overflow-hidden rounded-3xl border border-slate-200 bg-white text-left shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-[0_18px_45px_rgba(15,23,42,0.12)] focus:outline-none focus:ring-4 focus:ring-slate-100"
                    >
                        <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center text-slate-300">
                                    <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.6-4.6a2 2 0 0 1 2.8 0L16 16m-2-2 1.6-1.6a2 2 0 0 1 2.8 0L20 14m-6-6h.01M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute left-2 top-2 flex flex-wrap gap-1.5">
                                @if($product->is_on_sale)
                                    <span class="rounded-full bg-red-500 px-2 py-1 text-[10px] font-black text-white shadow-sm">
                                        -{{ $product->discount_percent }}%
                                    </span>
                                @endif
                                <span class="rounded-full bg-white/95 px-2 py-1 text-[10px] font-black text-slate-700 shadow-sm">
                                    {{ $product->condition_label }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-3 p-3">
                            <div>
                                <h3 class="line-clamp-2 min-h-[2.4rem] text-sm font-black leading-5 text-slate-950">
                                    {{ $product->name }}
                                </h3>
                                <p class="mt-1 text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">
                                    {{ $product->category ?? 'Produk' }}
                                </p>
                            </div>

                            <div class="flex items-end justify-between gap-2">
                                <div>
                                    @if($product->is_on_sale)
                                        <p class="text-xs font-bold text-slate-400 line-through">{{ rupiah($product->price) }}</p>
                                        <p class="text-base font-black text-red-500">{{ rupiah($product->final_price) }}</p>
                                    @else
                                        <p class="text-base font-black text-slate-950">{{ rupiah($product->price) }}</p>
                                    @endif
                                </div>
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-sm transition group-hover:bg-slate-800">
                                    <svg wire:loading.remove wire:target="addToCart({{ $product->id }})" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
                                    </svg>
                                    <svg wire:loading wire:target="addToCart({{ $product->id }})" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </button>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-3xl bg-slate-100 text-slate-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7m16 0v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5m16 0h-2.6a1 1 0 0 0-.7.3l-2.4 2.4a1 1 0 0 1-.7.3h-3.2a1 1 0 0 1-.7-.3l-2.4-2.4a1 1 0 0 0-.7-.3H4" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-black text-slate-950">Produk tidak ditemukan.</h3>
                        <p class="mt-2 text-sm font-semibold text-slate-500">Coba kata kunci lain atau cek kembali status produk.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif
</section>
