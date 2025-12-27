<header id="main-header" class="w-full border-b border-gray-200 dark:border-gray-800 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md transition-all duration-200 sticky top-0 z-[100]">
    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8 h-14 lg:h-16 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 lg:gap-3">
            @if($shopLogo)
                <img src="{{ Storage::url($shopLogo) }}" alt="{{ $shopName }}" class="h-8 w-8 lg:h-9 lg:w-9 rounded-2xl object-cover shadow-lg">
            @else
                <div class="h-8 w-8 lg:h-9 lg:w-9 rounded-2xl bg-blue-600 text-white font-bold flex items-center justify-center">{{ strtoupper(substr($shopName, 0, 1)) }}</div>
            @endif
            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                {{ $shopName }}
                <p class="text-[10px] font-normal text-gray-500 dark:text-gray-400">{{ $shopTagline }}</p>
            </div>
        </a>

        <nav class="hidden lg:flex items-center gap-5 text-[13px] font-medium text-gray-600 dark:text-gray-300">
            <a href="#tentang" class="smooth-scroll hover:text-gray-900 dark:hover:text-gray-100 hover:opacity-80 transition-opacity">Home</a>
            <a href="{{ route('landing.products.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100 hover:opacity-80 transition-opacity">Catalog</a>

            <a href="{{ route('landing.products.index', ['promo' => 1]) }}" class="smooth-scroll hover:text-gray-900 dark:hover:text-gray-100 inline-flex items-center gap-1">
                <span class="text-orange-500">🔥</span> Flash Sale
            </a>
        </nav>

        <div class="flex items-center gap-2 lg:gap-3">



            <button type="button" id="search-toggle" class="hidden md:flex h-9 w-9 lg:h-10 lg:w-10 items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 hover:opacity-80 transition-all" aria-label="Search">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button type="button" @click="$store.darkMode.toggle()" class="hidden md:flex h-9 w-9 lg:h-10 lg:w-10 items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition-transform hover:scale-105 active:scale-95" aria-label="Toggle theme">
                <svg x-show="!$store.darkMode.on" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M12 5V2M12 22v-3M5 12H2m20 0h-3M5.64 5.64L3.51 3.51m16.98 16.98-2.13-2.13M18.36 5.64l2.13-2.13M5.64 18.36l-2.13 2.13" stroke-linecap="round" />
                </svg>
                <svg x-show="$store.darkMode.on" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <button type="button" id="search-toggle-mobile" class="md:hidden h-9 w-9 inline-flex items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800" aria-label="Search">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <!-- Cart Button (Visible on Mobile & Desktop) -->
            <a href="{{ route('landing.cart.index') }}" class="flex h-9 w-9 lg:h-10 lg:w-10 items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 relative transition-transform hover:scale-105 active:scale-95 hover:opacity-80 transition-all" aria-label="Cart">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span data-cart-count class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-red-500 text-[10px] font-bold text-white flex items-center justify-center {{ session('cart_count', 0) > 0 ? '' : 'hidden' }}">{{ session('cart_count', 0) }}</span>
            </a>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="hidden lg:inline-flex items-center justify-center gap-2 h-10 px-4 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white font-semibold shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 hover:scale-105 active:scale-95 hover:opacity-90">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12l9-9 9 9" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 21V12h6v9" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('profile') }}" class="hidden lg:inline-flex group items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 hover:scale-105 active:scale-95" aria-label="Profil">
                        <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <span class="text-white font-medium text-xs">Profil</span>
                    </a>
                    <a href="{{ route('landing.orders.history') }}" class="hidden lg:inline-flex group items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 hover:scale-105 active:scale-95" aria-label="Riwayat">
                        <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-white font-medium text-xs">History</span>
                    </a>
                @endif
            @endauth
            @guest
                <a href="{{ route('login') }}" class="hidden lg:inline-flex px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 text-sm font-semibold transition">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hidden lg:inline-flex px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 text-sm font-semibold transition ml-2">Register</a>
                @endif
            @endguest

            <button type="button" class="lg:hidden h-9 w-9 inline-flex items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200" data-toggle-mobile-nav aria-label="Menu">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-nav" class="lg:hidden hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="px-4 py-4 space-y-4 text-sm text-gray-700 dark:text-gray-200">
            <div class="grid gap-3">
                <a href="#tentang">Home</a>
                <a href="{{ route('landing.products.index') }}">Catalog</a>

                <a href="{{ route('landing.products.index', ['promo' => 1]) }}" class="flex items-center gap-1"><span class="text-orange-500">🔥</span> Flash Sale</a>
                
                <!-- Theme Toggle -->
                <button type="button" @click="$store.darkMode.toggle()" class="flex items-center justify-between text-left hover:text-emerald-600 dark:hover:text-emerald-400 transition py-0.5" aria-label="Toggle theme">
                    <span>Theme</span>
                    <div class="flex items-center gap-2">
                        <svg x-show="!$store.darkMode.on" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M12 5V2M12 22v-3M5 12H2m20 0h-3M5.64 5.64L3.51 3.51m16.98 16.98-2.13-2.13M18.36 5.64l2.13-2.13M5.64 18.36l-2.13 2.13" stroke-linecap="round" />
                        </svg>
                        <svg x-show="$store.darkMode.on" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79z" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </button>
            </div>
            
            <!-- Categories Content (Hidden by default) -->
            <div id="mobile-categories-content" class="hidden">
                @if(isset($categories) && $categories->count() > 0)
                    <div class="grid grid-cols-2 gap-2 text-xs text-gray-500 dark:text-gray-400 pt-1">
                        @foreach ($categories->take(8) as $category)
                            <button type="button" data-category="{{ $category->name }}" class="filter-category px-2 py-1 rounded-lg border border-dashed border-gray-200 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400 transition text-left">
                                {{ $category->name }} <span class="text-[10px] text-gray-400">({{ $category->products_count }})</span>
                            </button>
                        @endforeach
                    </div>
                @else
                    <p class="text-[11px] text-gray-400 text-center py-2">No categories yet</p>
                @endif
            </div>
            <div class="flex gap-3 text-xs">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 dark:border-gray-700 px-3 py-2">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 12l9-9 9 9" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 21V12h6v9" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="group inline-flex items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 active:scale-95">
                            <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <span class="text-white font-medium text-xs">Profil</span>
                        </a>
                        <a href="{{ route('landing.orders.history') }}" class="group inline-flex items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 active:scale-95">
                            <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="text-white font-medium text-xs">History</span>
                        </a>
                        <a href="{{ route('landing.cart.index') }}" class="group inline-flex items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 active:scale-95">
                            <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="text-white font-medium text-xs">Cart ({{ session('cart_count') ?? 0 }})</span>
                        </a>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="flex-1 inline-flex justify-center rounded-xl border border-gray-200 dark:border-gray-700 px-3 py-2">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="flex-1 inline-flex justify-center rounded-xl bg-indigo-600 text-white px-3 py-2">Register</a>
                    @endif
                @endguest
            </div>
        </div>
    </div>

    <!-- Search Dropdown (Compact) -->
    <div id="search-modal" class="hidden absolute top-full left-4 right-4 md:left-auto md:right-0 mt-2 md:w-[400px] md:mr-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-2xl z-50">
        <div class="p-2.5">
            <div class="relative">
                <input type="text" id="search-input" placeholder="Search products..." class="w-full px-4 py-3 pl-9 pr-8 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500" autofocus>
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <button type="button" id="search-close" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" aria-label="Close search">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div id="search-results" class="mt-2 max-h-56 overflow-y-auto hidden">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1.5 px-0.5">Results:</p>
                <div id="search-results-container" class="space-y-1.5"></div>
            </div>
            <div id="search-no-results" class="hidden mt-2 text-center text-xs text-gray-500 dark:text-gray-400 py-3">
                <p>No products found</p>
            </div>
        </div>
    </div>
</header>


