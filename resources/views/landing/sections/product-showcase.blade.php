<div class="space-y-5 max-w-5xl mx-auto" id="produk" data-carousel="product-highlight" data-section="products">
    <div class="flex flex-wrap items-center gap-3 justify-between">
        <div>
            <p class="text-xs font-semibold tracking-[0.12em] text-gray-500 dark:text-gray-400 uppercase">Etalase produk terbaru</p>
            @auth
                @if (auth()->user()->isAdmin())
                    <p class="text-xs text-gray-500 dark:text-gray-400">Menarik langsung dari data dashboard kamu.</p>
                @else
                    <p class="text-xs text-gray-500 dark:text-gray-400">Koleksi pilihan kami untuk kamu.</p>
                @endif
            @else
                <p class="text-xs text-gray-500 dark:text-gray-400">Koleksi pilihan kami untuk kamu.</p>
            @endauth
        </div>
        @auth
            @if (auth()->user()->isAdmin())
                <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200 px-3 py-1 text-[10px] font-medium">
                    Sinkron otomatis
                </span>
            @endif
        @endauth
    </div>

    <div class="rounded-3xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-md p-4 sm:p-5">
        <div class="flex flex-wrap items-center gap-2 justify-between mb-4 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center gap-2">
                <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                <span id="filter-label">Produk highlight hari ini</span>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" id="reset-filter" class="hidden px-2 py-1 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition text-[11px]">
                    <span>✕ Reset</span>
                </button>
                @guest
                    <span class="text-[11px]">Login dulu untuk bisa order</span>
                @endguest
                <a href="{{ route('landing.products.index') }}" class="text-[11px] text-indigo-600 dark:text-indigo-400 hover:underline inline-flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="relative" data-carousel-wrapper>
            <button type="button" data-carousel-prev aria-label="Produk sebelumnya" class="hidden sm:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 h-8 w-8 items-center justify-center rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 z-10">
                <svg class="h-3 w-3 text-gray-600 dark:text-gray-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button type="button" data-carousel-next aria-label="Produk selanjutnya" class="hidden sm:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 h-8 w-8 items-center justify-center rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 z-10">
                <svg class="h-3 w-3 text-gray-600 dark:text-gray-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <div class="flex gap-3 overflow-x-auto pb-2 snap-x snap-mandatory scroll-smooth [-ms-overflow-style:'none'] [scrollbar-width:none]" data-carousel-container>
                <style>
                    #produk [data-carousel-container]::-webkit-scrollbar { display: none; }
                </style>
            
            <!-- Skeleton Loading State -->
            <template id="skeleton-template">
                <div class="flex-shrink-0 w-full max-w-[240px] snap-start rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 overflow-hidden animate-pulse">
                    <div class="w-full h-52 bg-gradient-to-br from-gray-200 via-gray-100 to-gray-200 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800"></div>
                    <div class="p-4 space-y-3">
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded-lg w-3/4"></div>
                        <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-1/2"></div>
                        <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-lg w-2/3 mt-2"></div>
                        <div class="h-9 bg-gray-200 dark:bg-gray-700 rounded-xl w-full mt-3"></div>
                    </div>
                </div>
            </template>
            
            @forelse ($featuredProducts as $product)
                <div data-product-card data-product-category="{{ $product->category }}" data-product-link="{{ $product->getActionLink() }}" class="group rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden flex flex-col min-w-[240px] max-w-[240px] snap-center transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/20 hover:scale-[1.02] hover:border-indigo-300 dark:hover:border-indigo-600" data-carousel-item>
                    <div class="relative w-full aspect-[4/3] overflow-hidden flex-shrink-0">
                        @if ($product->image)
                            <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" loading="lazy" width="240" height="180" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 dark:from-indigo-900/30 dark:via-purple-900/30 dark:to-pink-900/30 flex items-center justify-center text-[10px] text-gray-600 dark:text-gray-300">
                                <svg class="h-12 w-12 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <path d="M21 15l-5-5L5 21"/>
                                </svg>
                            </div>
                        @endif
                        @if ($product->is_on_sale)
                            <div class="absolute top-2 left-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg animate-pulse">
                                -{{ $product->discount_percent }}%
                            </div>
                        @endif
                    </div>
                    <div class="p-3 flex flex-col flex-1 bg-gradient-to-b from-transparent to-gray-50/50 dark:to-gray-900/50">
                        <div class="flex-1 space-y-2">
                            <h3 data-product-name class="text-sm font-bold text-gray-900 dark:text-gray-100 line-clamp-2 leading-tight min-h-[2.5rem]">{{ \Illuminate\Support\Str::title($product->name) }}</h3>
                            <div class="flex items-center gap-2 text-[11px]">
                                <span class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-white font-bold shadow-sm
                                    {{ $product->condition_class }}"
                                    style="background-color: {{ $product->condition_color }};">
                                    {{ $product->condition_label }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-2 border-t border-gray-100 dark:border-gray-700">
                            <div>
                                @if ($product->is_on_sale)
                                    <span class="text-xs text-gray-400 line-through">{{ rupiah($product->price) }}</span>
                                    <span data-product-price class="text-base font-bold text-red-500">{{ rupiah($product->final_price) }}</span>
                                @else
                                    <span data-product-price class="text-base font-bold text-green-600">{{ rupiah($product->price) }}</span>
                                @endif
                            </div>
                        </div>

                        @if ($product->is_available)
                            <div class="mt-4 flex items-center justify-center">
                                <div class="flex gap-2 w-full max-w-[220px]">
                                    <form action="{{ route('landing.cart.store') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" aria-label="Tambah {{ $product->name }} ke keranjang" class="w-full inline-flex items-center justify-center rounded-full bg-slate-900 text-white px-3 py-2.5 text-sm font-semibold shadow-md hover:bg-slate-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 hover:opacity-90">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('landing.products.checkout', ['product' => $product, 'from' => 'home']) }}"
                                       class="flex-[2] inline-flex items-center justify-center rounded-full bg-emerald-500 px-3 py-2.5 text-sm font-semibold text-white shadow-md shadow-emerald-500/40 transition hover:bg-emerald-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400 focus-visible:ring-offset-2 hover:opacity-90"
                                       style="background-color: #047857;">
                                        Buy Now
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="min-w-full rounded-2xl border border-dashed border-gray-200 dark:border-gray-700 bg-transparent flex items-center justify-center p-6 text-center text-xs text-gray-400 dark:text-gray-500" data-carousel-item>
                    @auth
                        @if (auth()->user()->isAdmin())
                            Belum ada produk aktif. Tambahkan produk di dashboard untuk menampilkan etalase otomatis di sini.
                        @else
                            Produk sedang dalam proses kurasi. Cek lagi nanti ya! ✨
                        @endif
                    @else
                        Produk sedang dalam proses kurasi. Cek lagi nanti ya! ✨
                    @endauth
                </div>
            @endforelse

            @auth
                @if ($featuredProducts->isNotEmpty() && auth()->user()->isAdmin())
                    <div class="group rounded-2xl border border-dashed border-gray-200 dark:border-gray-700 bg-transparent flex items-center justify-center p-3 min-w-[200px] snap-center" data-carousel-item>
                        <div class="text-center text-[11px] text-gray-400 dark:text-gray-500">
                            Update produk di dashboard kapan saja.<br>Perubahan langsung tercermin di landing page.
                        </div>
                    </div>
                @endif
            @endauth
            </div>
        </div>

        @if ($hasMoreProducts)
            <div class="mt-4 flex justify-center">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-xl border border-indigo-200 bg-indigo-50 px-4 py-2 text-xs font-semibold text-indigo-700 hover:bg-indigo-100">
                            Lihat semua produk di dashboard
                        </a>
                    @else
                        <p class="text-xs text-gray-500 dark:text-gray-400">Masih banyak koleksi menarik lainnya! 🛍️</p>
                    @endif
                @else
                    <p class="text-xs text-gray-500 dark:text-gray-400">Login untuk melihat lebih banyak produk.</p>
                @endauth
            </div>
        @endif
    </div>
</div>


