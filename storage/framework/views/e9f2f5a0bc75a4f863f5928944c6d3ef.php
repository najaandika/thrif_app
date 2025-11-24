<?php
    $cartCount = session('cart_count', 0);
    $shopLogo = \App\Models\Setting::get('shop_logo');
    $shopName = \App\Models\Setting::get('shop_name', 'Thrif');
    $shopTagline = \App\Models\Setting::get('shop_tagline', 'Your trusted thrift store');
?>

<header id="main-header" class="w-full border-b border-gray-200 dark:border-gray-800 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md transition-all duration-200 sticky top-0 z-[100]">
    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8 h-14 lg:h-16 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 lg:gap-3">
            <?php if($shopLogo): ?>
                <img src="<?php echo e(Storage::url($shopLogo)); ?>" alt="<?php echo e($shopName); ?>" class="h-8 w-8 lg:h-9 lg:w-9 rounded-2xl object-cover shadow-lg">
            <?php else: ?>
                <div class="h-8 w-8 lg:h-9 lg:w-9 rounded-2xl bg-indigo-600 text-white font-bold flex items-center justify-center"><?php echo e(strtoupper(substr($shopName, 0, 1))); ?></div>
            <?php endif; ?>
            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                <?php echo e($shopName); ?>

                <p class="text-[10px] font-normal text-gray-500 dark:text-gray-400"><?php echo e($shopTagline); ?></p>
            </div>
        </a>

        <nav class="hidden lg:flex items-center gap-5 text-[13px] font-medium text-gray-600 dark:text-gray-300">
            <a href="#tentang" class="smooth-scroll hover:text-gray-900 dark:hover:text-gray-100">Home</a>
            <a href="<?php echo e(route('landing.products.index')); ?>" class="hover:text-gray-900 dark:hover:text-gray-100">Product</a>
            <div class="relative group">
                <button type="button" class="inline-flex items-center gap-1 hover:text-gray-900 dark:hover:text-gray-100">
                    Categories
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 transition absolute left-0 mt-3 w-56 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-xl p-4 text-xs space-y-2">
                    <?php if(isset($categories) && $categories->count() > 0): ?>
                        <div class="grid grid-cols-2 gap-2">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" data-category="<?php echo e($category->name); ?>" class="filter-category text-left px-2 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 flex items-center justify-between transition">
                                    <span><?php echo e($category->name); ?></span>
                                    <span class="text-[10px] text-gray-400">(<?php echo e($category->products_count); ?>)</span>
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-[11px] text-gray-400 text-center py-2">No categories yet</p>
                    <?php endif; ?>
                </div>
            </div>
            <a href="#produk" class="smooth-scroll hover:text-gray-900 dark:hover:text-gray-100">New Arrivals</a>
            <a href="#produk" class="smooth-scroll hover:text-gray-900 dark:hover:text-gray-100">Best Seller</a>
            <a href="#produk" class="smooth-scroll hover:text-gray-900 dark:hover:text-gray-100">Promo</a>
        </nav>

        <div class="flex items-center gap-2 lg:gap-3">
            <button type="button" id="search-toggle" class="hidden md:flex h-9 w-9 lg:h-10 lg:w-10 items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800" aria-label="Search">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button type="button" @click="$store.darkMode.toggle()" class="hidden md:flex h-9 w-9 lg:h-10 lg:w-10 items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800" aria-label="Toggle theme">
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

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="hidden lg:inline-flex items-center justify-center gap-2 h-10 px-4 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white font-semibold shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 hover:scale-105 active:scale-95">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12l9-9 9 9" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 21V12h6v9" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('profile')); ?>" class="hidden lg:inline-flex group items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 hover:scale-105 active:scale-95" aria-label="Profil">
                        <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <span class="text-white font-medium text-xs">Profil</span>
                    </a>
                    <a href="<?php echo e(route('landing.orders.history')); ?>" class="hidden lg:inline-flex group items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 hover:scale-105 active:scale-95" aria-label="Riwayat">
                        <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-white font-medium text-xs">History</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="hidden lg:inline-flex px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 text-sm font-semibold transition">Login</a>
                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>" class="hidden lg:inline-flex px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 text-sm font-semibold transition ml-2">Register</a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="#cart" class="relative inline-flex h-9 w-9 lg:h-10 lg:w-10 items-center justify-center rounded-2xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800" aria-label="Keranjang">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 6h15l-1.5 9h-12z" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="9" cy="20" r="1" />
                    <circle cx="18" cy="20" r="1" />
                </svg>
                <?php if($cartCount > 0): ?>
                    <span class="absolute -top-1 -right-1 inline-flex h-5 min-w-[20px] px-1.5 items-center justify-center rounded-full bg-rose-500 text-[10px] font-semibold text-white leading-none">
                        <?php echo e($cartCount); ?>

                    </span>
                <?php endif; ?>
            </a>

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
                <a href="<?php echo e(route('landing.products.index')); ?>">Product</a>
                
                <!-- Categories Collapsible -->
                <button type="button" id="mobile-categories-toggle" class="flex items-center justify-between text-left hover:text-emerald-600 dark:hover:text-emerald-400 transition py-0.5">
                    <span>Categories</span>
                    <svg id="mobile-categories-icon" class="h-3.5 w-3.5 transition-transform duration-300 ease-in-out text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <a href="#produk">New Arrivals</a>
                <a href="#produk">Best Seller</a>
                <a href="#produk">Promo</a>
                
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
                <?php if(isset($categories) && $categories->count() > 0): ?>
                    <div class="grid grid-cols-2 gap-2 text-xs text-gray-500 dark:text-gray-400 pt-1">
                        <?php $__currentLoopData = $categories->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" data-category="<?php echo e($category->name); ?>" class="filter-category px-2 py-1 rounded-lg border border-dashed border-gray-200 dark:border-gray-700 hover:border-emerald-500 dark:hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400 transition text-left">
                                <?php echo e($category->name); ?> <span class="text-[10px] text-gray-400">(<?php echo e($category->products_count); ?>)</span>
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-[11px] text-gray-400 text-center py-2">No categories yet</p>
                <?php endif; ?>
            </div>
            <div class="flex gap-3 text-xs">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 dark:border-gray-700 px-3 py-2">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 12l9-9 9 9" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 21V12h6v9" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('profile')); ?>" class="group inline-flex items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 active:scale-95">
                            <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <span class="text-white font-medium text-xs">Profil</span>
                        </a>
                        <a href="<?php echo e(route('landing.orders.history')); ?>" class="group inline-flex items-center justify-center gap-1.5 h-10 px-2.5 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-md shadow-emerald-500/30 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/40 active:scale-95">
                            <svg class="h-4 w-4 text-white drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="text-white font-medium text-xs">History</span>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="flex-1 inline-flex justify-center rounded-xl border border-gray-200 dark:border-gray-700 px-3 py-2">Login</a>
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="flex-1 inline-flex justify-center rounded-xl bg-indigo-600 text-white px-3 py-2">Register</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Search Dropdown (Compact) -->
    <div id="search-modal" class="hidden absolute top-full left-4 right-4 md:left-auto md:right-0 mt-2 md:w-[400px] md:mr-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-2xl z-50">
        <div class="p-2.5">
            <div class="relative">
                <input type="text" id="search-input" placeholder="Search products..." class="w-full px-3 py-2 pl-9 pr-8 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" autofocus>
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <button type="button" id="search-close" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Smooth scroll functionality
        document.querySelectorAll('.smooth-scroll, a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href && href.startsWith('#') && href !== '#') {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        const headerHeight = 64; // Height of sticky header
                        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                        
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Header sticky animation
        const header = document.getElementById('main-header');
        let lastScroll = 0;
        const headerHeight = header?.offsetHeight || 64;

        const handleScroll = () => {
            if (!header) return;
            
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > headerHeight) {
                header.classList.add('shadow-lg', 'shadow-gray-900/10', 'dark:shadow-gray-100/5');
            } else {
                header.classList.remove('shadow-lg', 'shadow-gray-900/10', 'dark:shadow-gray-100/5');
            }
            
            lastScroll = currentScroll;
        };

        window.addEventListener('scroll', handleScroll, { passive: true });

        // Mobile nav toggle
        const mobileNavToggles = document.querySelectorAll('[data-toggle-mobile-nav]');
        const mobileNav = document.getElementById('mobile-nav');

        if (mobileNavToggles.length && mobileNav) {
            mobileNavToggles.forEach((toggle) => {
                toggle.addEventListener('click', () => {
                    mobileNav.classList.toggle('hidden');
                });
            });
        }

        // Mobile categories toggle
        const mobileCategoriesToggle = document.getElementById('mobile-categories-toggle');
        const mobileCategoriesContent = document.getElementById('mobile-categories-content');
        const mobileCategoriesIcon = document.getElementById('mobile-categories-icon');

        mobileCategoriesToggle?.addEventListener('click', () => {
            mobileCategoriesContent?.classList.toggle('hidden');
            mobileCategoriesIcon?.classList.toggle('rotate-180');
        });

        // Search functionality
        const searchToggle = document.getElementById('search-toggle');
        const searchToggleMobile = document.getElementById('search-toggle-mobile');
        const searchModal = document.getElementById('search-modal');
        const searchInput = document.getElementById('search-input');
        const searchClose = document.getElementById('search-close');
        const searchResults = document.getElementById('search-results');
        const searchResultsContainer = document.getElementById('search-results-container');
        const searchNoResults = document.getElementById('search-no-results');

        // Toggle search modal
        const toggleSearch = () => {
            searchModal?.classList.toggle('hidden');
            if (!searchModal?.classList.contains('hidden')) {
                searchInput?.focus();
            }
        };

        searchToggle?.addEventListener('click', toggleSearch);
        searchToggleMobile?.addEventListener('click', toggleSearch);

        // Close search modal
        searchClose?.addEventListener('click', () => {
            searchModal?.classList.add('hidden');
            searchInput.value = '';
            searchResults?.classList.add('hidden');
            searchNoResults?.classList.add('hidden');
        });

        // Close search on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !searchModal?.classList.contains('hidden')) {
                searchClose?.click();
            }
        });

        // Close search when clicking outside
        document.addEventListener('click', (e) => {
            if (!searchModal?.classList.contains('hidden')) {
                if (!searchModal.contains(e.target) && !searchToggle?.contains(e.target) && !searchToggleMobile?.contains(e.target)) {
                    searchClose?.click();
                }
            }
        });

        // Search products
        let searchTimeout;
        searchInput?.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            const query = e.target.value.trim().toLowerCase();

            if (query.length === 0) {
                searchResults?.classList.add('hidden');
                searchNoResults?.classList.add('hidden');
                return;
            }

            searchTimeout = setTimeout(() => {
                // Get all product cards
                const productCards = document.querySelectorAll('[data-product-card]');
                const results = [];

                productCards.forEach(card => {
                    const name = card.querySelector('[data-product-name]')?.textContent.toLowerCase() || '';
                    const category = card.getAttribute('data-product-category')?.toLowerCase() || '';
                    const price = card.querySelector('[data-product-price]')?.textContent || '';

                    if (name.includes(query) || category.includes(query)) {
                        const image = card.querySelector('img')?.src || '';
                        // Prefer explicit data-product-link if available
                        const link = card.getAttribute('data-product-link') || card.querySelector('a[href]')?.href || '#';

                        results.push({
                            name: card.querySelector('[data-product-name]')?.textContent || '',
                            category: card.getAttribute('data-product-category') || '',
                            price: price,
                            image: image,
                            link: link
                        });
                    }
                });

                // Display results
                if (results.length > 0) {
                    searchResultsContainer.innerHTML = results.map(product => `
                        <a href="${product.link}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <img src="${product.image}" alt="${product.name}" class="w-14 h-14 object-cover rounded flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-[15px] text-gray-900 dark:text-gray-100 truncate leading-tight">${product.name}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">${product.category}</p>
                            </div>
                            <p class="font-semibold text-[15px] text-emerald-600 dark:text-emerald-400 flex-shrink-0">${product.price}</p>
                        </a>
                    `).join('');
                    searchResults?.classList.remove('hidden');
                    searchNoResults?.classList.add('hidden');
                } else {
                    searchResults?.classList.add('hidden');
                    searchNoResults?.classList.remove('hidden');
                }
            }, 300);
        });

        // Redirect to /landing/products?search=... when user presses Enter in search input
        searchInput?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                const query = searchInput.value.trim();
                if (query.length > 0) {
                    window.location.href = `/landing/products?search=${encodeURIComponent(query)}`;
                }
            }
        });

        // Theme toggle functionality
        // Now handled by Alpine.js darkMode store in app.js
        // No custom implementation needed here
    });
</script>
<?php /**PATH C:\laragon\www\thrif\resources\views/landing/sections/header.blade.php ENDPATH**/ ?>