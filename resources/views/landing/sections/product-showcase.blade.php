<div class="space-y-5 max-w-6xl mx-auto" id="produk" data-carousel="product-highlight" data-section="products">
    <div class="flex flex-wrap items-end gap-4 justify-between">
        <div class="max-w-xl">
            <p class="text-xs font-semibold tracking-[0.14em] text-gray-500 uppercase">Etalase terbaru</p>
            <h2 class="mt-2 text-2xl font-semibold tracking-tight text-gray-950">Barang baru masuk, siap dipilih.</h2>
            @auth
                @if (auth()->user()->isAdmin())
                    <p class="mt-2 text-sm text-gray-500">Data etalase otomatis mengikuti produk aktif dari dashboard.</p>
                @else
                    <p class="mt-2 text-sm text-gray-500">Koleksi terbaru yang sudah dicek kondisi, ukuran, dan stoknya.</p>
                @endif
            @else
                <p class="mt-2 text-sm text-gray-500">Koleksi terbaru yang sudah dicek kondisi, ukuran, dan stoknya.</p>
            @endauth
        </div>

        <a href="{{ route('landing.products.index') }}" class="inline-flex min-h-11 items-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 transition hover:bg-gray-50">
            Buka katalog
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <div class="rounded-[1.75rem] border border-gray-200 bg-white p-3 shadow-sm sm:p-4">
        <div class="notion-caption mb-3"><span></span>Collection board</div>
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 px-1 pb-4 text-xs text-gray-500">
            <div class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                <span id="filter-label">Drop pilihan hari ini</span>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" id="reset-filter" class="hidden rounded-lg bg-gray-100 px-2 py-1 text-[11px] text-gray-600 transition hover:bg-gray-200">
                    Reset
                </button>
                @guest
                    <span class="text-[11px]">Stok siap dipilih</span>
                @endguest
            </div>
        </div>

        <div class="relative mt-4" data-carousel-wrapper>
            <button type="button" data-carousel-prev aria-label="Produk sebelumnya" class="hidden sm:flex absolute left-0 top-1/2 z-10 h-9 w-9 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-gray-200 bg-white shadow-sm transition hover:bg-gray-50">
                <svg class="h-4 w-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button type="button" data-carousel-next aria-label="Produk selanjutnya" class="hidden sm:flex absolute right-0 top-1/2 z-10 h-9 w-9 translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-gray-200 bg-white shadow-sm transition hover:bg-gray-50">
                <svg class="h-4 w-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <div class="flex gap-4 overflow-x-auto pb-2 snap-x snap-mandatory scroll-smooth [-ms-overflow-style:'none'] [scrollbar-width:none]" data-carousel-container>
                <style>
                    #produk [data-carousel-container]::-webkit-scrollbar { display: none; }
                </style>

                <template id="skeleton-template">
                    <div class="flex-shrink-0 w-full max-w-[260px] snap-start rounded-2xl border border-gray-200 bg-white overflow-hidden animate-pulse">
                        <div class="w-full aspect-[4/5] bg-gray-200"></div>
                        <div class="p-4 space-y-3">
                            <div class="h-4 bg-gray-200 rounded-lg w-3/4"></div>
                            <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                            <div class="h-8 bg-gray-200 rounded-xl w-full"></div>
                        </div>
                    </div>
                </template>

                @forelse ($featuredProducts as $product)
                    <article data-product-card data-product-category="{{ $product->category }}" data-product-link="{{ $product->getActionLink() }}" class="group flex min-w-[224px] max-w-[224px] snap-start flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white transition-all duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-xl hover:shadow-gray-950/10" data-carousel-item>
                        <a href="{{ route('landing.products.show', ['product' => $product, 'from' => 'home']) }}" class="block">
                            <div class="relative aspect-[4/5] w-full overflow-hidden bg-gray-100">
                                @if ($product->image)
                                    <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" loading="lazy" width="224" height="280" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center text-xs text-gray-500">No image</div>
                                @endif
                                <div class="absolute left-2 top-2 flex flex-wrap gap-1.5">
                                    <span class="rounded-full border px-2 py-0.5 text-[10px] font-semibold shadow-sm" style="border-color: {{ $product->condition_color }}33; background-color: {{ $product->condition_color }}14; color: {{ $product->condition_color }};">
                                        {{ $product->condition_label }}
                                    </span>
                                    @if ($product->is_on_sale)
                                        <span class="rounded-full bg-red-600 px-2 py-1 text-[10px] font-semibold text-white shadow-sm">
                                            -{{ $product->discount_percent }}%
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>

                        <div class="flex flex-1 flex-col p-3.5">
                            <a href="{{ route('landing.products.show', ['product' => $product, 'from' => 'home']) }}" class="block">
                                <h3 data-product-name class="line-clamp-2 min-h-[2.5rem] text-sm font-semibold leading-snug text-gray-950 transition group-hover:text-gray-700">{{ \Illuminate\Support\Str::title($product->name) }}</h3>
                            </a>

                            <div class="mt-3 flex items-end justify-between gap-3 border-t border-gray-100 pt-3">
                                <div>
                                    @if ($product->is_on_sale)
                                        <span class="block text-xs text-gray-400 line-through">{{ rupiah($product->price) }}</span>
                                        <span data-product-price class="text-base font-bold text-red-600">{{ rupiah($product->final_price) }}</span>
                                    @else
                                        <span data-product-price class="text-base font-bold text-gray-950">{{ rupiah($product->price) }}</span>
                                    @endif
                                </div>
                            </div>

                            @if ($product->is_available)
                                <a href="{{ route('landing.products.show', ['product' => $product, 'from' => 'home']) }}" aria-label="Lihat detail {{ $product->name }}" class="mt-3 inline-flex h-10 w-full items-center justify-center rounded-xl bg-gray-950 px-3 text-xs font-semibold text-white transition hover:bg-gray-800">
                                    Lihat Detail
                                </a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="min-w-full rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-8 text-center text-sm text-gray-500" data-carousel-item>
                        @auth
                            @if (auth()->user()->isAdmin())
                                Belum ada produk aktif. Tambahkan produk di dashboard agar etalase tampil otomatis.
                            @else
                                Produk sedang dalam proses kurasi. Cek lagi nanti.
                            @endif
                        @else
                            Produk sedang dalam proses kurasi. Cek lagi nanti.
                        @endauth
                    </div>
                @endforelse

                @auth
                    @if ($featuredProducts->isNotEmpty() && auth()->user()->isAdmin())
                        <div class="flex min-w-[220px] snap-start items-center justify-center rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-4 text-center text-xs text-gray-500" data-carousel-item>
                            Update produk di dashboard. Perubahan langsung tampil di landing page.
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        @if ($hasMoreProducts)
            <div class="mt-4 flex justify-center">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 bg-gray-50 px-4 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-100">
                            Kelola semua produk
                        </a>
                    @else
                        <p class="text-xs text-gray-500">Masih ada koleksi lain di halaman katalog.</p>
                    @endif
                @else
                    <p class="text-xs text-gray-500">Buka katalog untuk melihat semua koleksi yang tersedia.</p>
                @endauth
            </div>
        @endif
    </div>

    @if ($featuredProducts->count() > 4)
        <div class="pt-5">
            <div class="mb-4 flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-gray-500">More picks</p>
                    <h3 class="mt-1 text-lg font-semibold tracking-tight text-gray-950">Item lain yang masih siap dipilih.</h3>
                </div>
                <a href="{{ route('landing.products.index') }}" class="hidden text-sm font-semibold text-gray-600 transition hover:text-gray-950 sm:inline-flex">
                    Buka katalog
                </a>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($featuredProducts->skip(4)->take(8) as $product)
                    <a href="{{ route('landing.products.show', ['product' => $product, 'from' => 'home']) }}" class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-950/5">
                        <div class="relative aspect-[4/5] overflow-hidden bg-gray-100">
                            @if ($product->image)
                                <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center text-xs text-gray-400">No image</div>
                            @endif
                            @if ($product->is_on_sale)
                                <span class="absolute left-2 top-2 rounded-full bg-red-600 px-2 py-1 text-[10px] font-semibold text-white">-{{ $product->discount_percent }}%</span>
                            @endif
                        </div>
                        <div class="space-y-2 p-3">
                            <p class="line-clamp-2 min-h-[2.5rem] text-sm font-semibold leading-snug text-gray-950">{{ \Illuminate\Support\Str::title($product->name) }}</p>
                            <div class="flex items-center justify-between gap-2">
                                @if ($product->is_on_sale)
                                    <div>
                                        <span class="block text-[11px] text-gray-400 line-through">{{ rupiah($product->price) }}</span>
                                        <span class="text-sm font-bold text-red-600">{{ rupiah($product->final_price) }}</span>
                                    </div>
                                @else
                                    <span class="text-sm font-bold text-gray-950">{{ rupiah($product->price) }}</span>
                                @endif
                                <span class="rounded-full border px-2 py-0.5 text-[10px] font-semibold shadow-sm" style="border-color: {{ $product->condition_color }}33; background-color: {{ $product->condition_color }}14; color: {{ $product->condition_color }};">{{ $product->condition_label }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>



