<header id="main-header" class="sticky top-0 z-[100] w-full border-b border-gray-200/80 bg-white/92 backdrop-blur-xl transition-all duration-200 md:border-b-0 md:bg-transparent md:px-4 md:py-3">
    <div id="header-toolbar" class="mx-auto grid h-16 max-w-6xl grid-cols-[1fr_auto] items-center gap-3 px-4 transition-all duration-200 sm:px-6 md:h-14 md:rounded-[1.35rem] md:border md:border-gray-200/80 md:bg-white/90 md:px-4 md:shadow-lg md:shadow-gray-950/8 md:backdrop-blur-xl lg:grid-cols-[260px_1fr_220px] lg:px-5">
        <a href="/" class="flex min-w-0 items-center gap-3" aria-label="{{ $shopName }} home">
            @if($shopLogo)
                <img src="{{ media_url($shopLogo) }}" alt="{{ $shopName }}" width="40" height="40" class="h-10 w-10 shrink-0 rounded-2xl object-cover ring-1 ring-gray-200">
            @else
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-gray-950 text-sm font-bold text-white">{{ strtoupper(substr($shopName, 0, 1)) }}</div>
            @endif
            <div class="min-w-0 leading-tight">
                <p class="truncate text-sm font-bold tracking-tight text-gray-950">{{ $shopName }}</p>
                <p class="hidden max-w-[180px] truncate text-[11px] font-medium text-gray-500 sm:block">{{ $shopTagline }}</p>
            </div>
        </a>

        <nav class="hidden w-fit items-center justify-self-center rounded-2xl border border-gray-200 bg-gray-50/80 p-1 text-sm font-semibold text-gray-600 lg:flex">
            <a href="#tentang" class="smooth-scroll rounded-xl bg-white px-3.5 py-2 text-gray-950 shadow-sm transition hover:bg-white">Home</a>
            <a href="{{ route('landing.products.index') }}" class="rounded-xl px-3.5 py-2 transition hover:bg-white hover:text-gray-950">Katalog</a>
            <a href="{{ route('landing.products.index', ['promo' => 1]) }}" class="inline-flex items-center gap-2 rounded-xl px-3.5 py-2 text-red-600 transition hover:bg-white hover:text-red-700"><span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>Flash Sale</a>
        </nav>

        <div class="flex items-center justify-end gap-2.5">
            <button type="button" id="search-toggle" class="hidden h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-700 transition hover:bg-gray-50 hover:text-gray-950 md:flex" aria-label="Cari produk">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <button type="button" id="search-toggle-mobile" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-700 transition hover:bg-gray-50 md:hidden" aria-label="Cari produk">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <a href="{{ route('landing.cart.index') }}" class="relative hidden h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-700 transition hover:bg-gray-50 hover:text-gray-950 md:flex" aria-label="Keranjang">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1" />
                    <circle cx="20" cy="21" r="1" />
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span data-cart-count class="absolute -right-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-600 px-1 text-[10px] font-bold text-white {{ session('cart_count', 0) > 0 ? '' : 'hidden' }}">{{ session('cart_count', 0) }}</span>
            </a>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="hidden h-10 items-center justify-center gap-2 rounded-xl bg-gray-950 px-4 text-sm font-semibold text-white transition hover:bg-gray-800 lg:inline-flex">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12l9-9 9 9" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 21V12h6v9" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('profile') }}" class="hidden h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-700 transition hover:bg-gray-50 hover:text-gray-950 lg:inline-flex" aria-label="Profil akun">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 21a8 8 0 0 1 16 0" stroke-linecap="round" />
                        </svg>
                    </a>
                @endif
            @endauth

            @guest
                <a href="{{ route('login') }}" class="hidden h-10 items-center rounded-xl border border-gray-200/80 bg-white/80 px-4 text-sm font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-white hover:text-gray-950 lg:inline-flex">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hidden h-10 items-center rounded-xl bg-gray-950 px-3.5 text-sm font-semibold text-white shadow-sm shadow-gray-950/10 transition hover:bg-gray-800 lg:inline-flex">Daftar</a>
                @endif
            @endguest
</div>
    </div>

    <div id="search-modal" class="fixed inset-x-4 top-[5.75rem] z-[120] hidden overflow-hidden rounded-[1.5rem] border border-gray-200 bg-white/95 shadow-2xl shadow-gray-950/15 backdrop-blur-xl md:absolute md:left-auto md:right-0 md:top-full md:mr-4 md:mt-4 md:w-[410px]">
        <div class="border-b border-gray-100 p-3">
            <div class="relative">
                <input type="text" id="search-input" placeholder="Cari item, brand, atau kategori" class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3.5 pl-10 pr-10 text-base font-semibold text-gray-950 outline-none placeholder:text-gray-400 transition focus:border-gray-950 focus:bg-white focus:ring-4 focus:ring-gray-950/10 md:text-sm" autofocus>
                <svg class="absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <button type="button" id="search-close" class="absolute right-3 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full text-gray-400 transition hover:bg-gray-200 hover:text-gray-700" aria-label="Tutup pencarian">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="mt-3 flex flex-wrap gap-2 text-[11px] font-semibold text-gray-400" aria-hidden="true">
                <span class="rounded-full bg-gray-50 px-2.5 py-1 ring-1 ring-gray-100">Brand</span>
                <span class="rounded-full bg-gray-50 px-2.5 py-1 ring-1 ring-gray-100">Kategori</span>
                <span class="rounded-full bg-gray-50 px-2.5 py-1 ring-1 ring-gray-100">Harga</span>
            </div>
        </div>
        <div class="p-3">
            <div id="search-idle" class="rounded-2xl bg-gray-50 px-4 py-4 text-sm leading-6 text-gray-500 md:text-xs md:leading-5">Cari berdasarkan nama produk, brand, atau kategori. Tekan Enter untuk membuka katalog lengkap.</div>
            <div id="search-results" class="hidden max-h-72 overflow-y-auto pr-1">
                <div class="mb-2 flex items-center justify-between px-1 text-xs text-gray-500">
                    <span>Hasil pencarian</span>
                    <span>Enter untuk katalog</span>
                </div>
                <div id="search-results-container" class="space-y-2"></div>
            </div>
            <div id="search-no-results" class="hidden rounded-2xl border border-dashed border-gray-200 bg-gray-50 px-4 py-6 text-center">
                <p class="text-sm font-semibold text-gray-900">Produk tidak ditemukan</p>
                <p class="mt-1 text-xs leading-5 text-gray-500">Coba kata kunci lain, brand, atau buka katalog untuk lihat semua item.</p>
            </div>
        </div>
    </div>
</header>

<nav id="mobile-bottom-nav" class="fixed inset-x-5 bottom-4 z-[90] rounded-2xl border border-gray-200 bg-white/95 px-2 py-1.5 shadow-xl shadow-gray-950/10 backdrop-blur-xl transition duration-200 lg:hidden" aria-label="Mobile navigation">
        <div class="grid grid-cols-5 items-center gap-1 text-[10px] font-semibold text-gray-500">
            <a href="#tentang" class="smooth-scroll flex flex-col items-center gap-0.5 rounded-xl bg-gray-950 px-1.5 py-1.5 text-white">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M3 11.5L12 4l9 7.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M5 10.5V20h14v-9.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Home</span>
            </a>
            <a href="{{ route('landing.products.index') }}" class="flex flex-col items-center gap-0.5 rounded-xl px-1.5 py-1.5 transition hover:bg-gray-100 hover:text-gray-950">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <rect x="4" y="4" width="6" height="6" rx="1.5" />
                    <rect x="14" y="4" width="6" height="6" rx="1.5" />
                    <rect x="4" y="14" width="6" height="6" rx="1.5" />
                    <rect x="14" y="14" width="6" height="6" rx="1.5" />
                </svg>
                <span>Katalog</span>
            </a>
            <a href="{{ route('landing.products.index', ['promo' => 1]) }}" class="flex flex-col items-center gap-0.5 rounded-xl px-1.5 py-1.5 text-red-600 transition hover:bg-red-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M19 5L5 19" stroke-linecap="round" />
                    <circle cx="7" cy="7" r="2" />
                    <circle cx="17" cy="17" r="2" />
                </svg>
                <span>Sale</span>
            </a>
            <a href="{{ route('landing.cart.index') }}" class="relative flex flex-col items-center gap-0.5 rounded-xl px-1.5 py-1.5 transition hover:bg-gray-100 hover:text-gray-950">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="9" cy="21" r="1" />
                    <circle cx="20" cy="21" r="1" />
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Cart</span>
                <span data-cart-count class="absolute right-2 top-0.5 flex h-3.5 min-w-3.5 items-center justify-center rounded-full bg-red-600 px-1 text-[8px] font-bold text-white {{ session('cart_count', 0) > 0 ? '' : 'hidden' }}">{{ session('cart_count', 0) }}</span>
            </a>
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-0.5 rounded-xl px-1.5 py-1.5 transition hover:bg-gray-100 hover:text-gray-950">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M4 4h16v16H4z" stroke-linejoin="round" />
                            <path d="M4 9h16M9 20V9" stroke-linecap="round" />
                        </svg>
                        <span>Admin</span>
                    </a>
                @else
                    <a href="{{ route('profile') }}" class="flex flex-col items-center gap-0.5 rounded-xl px-1.5 py-1.5 transition hover:bg-gray-100 hover:text-gray-950">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 21a8 8 0 0 1 16 0" stroke-linecap="round" />
                        </svg>
                        <span>Akun</span>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="flex flex-col items-center gap-0.5 rounded-xl px-1.5 py-1.5 transition hover:bg-gray-100 hover:text-gray-950">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21a8 8 0 0 1 16 0" stroke-linecap="round" />
                    </svg>
                    <span>Masuk</span>
                </a>
            @endauth
        </div>
    </nav>





