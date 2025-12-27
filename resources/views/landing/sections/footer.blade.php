<footer class="border-t border-gray-200 dark:border-gray-800 bg-gradient-to-b from-transparent to-gray-50 dark:to-gray-900/50 mt-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Column 1: Brand & Info -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    @if($shopLogo)
                        <img src="{{ Storage::url($shopLogo) }}" alt="{{ $shopName }}" class="h-10 w-10 rounded-2xl object-cover shadow-lg flex-shrink-0">
                    @else
                        <div class="h-10 w-10 rounded-2xl bg-blue-600 text-white font-bold flex items-center justify-center shadow-lg flex-shrink-0">
                            {{ strtoupper(substr($shopName, 0, 1)) }}
                        </div>
                    @endif
                    <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                        {{ $shopName }}
                    </div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    {{ $shopTagline }}
                </p>
                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 flex-shrink-0 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 uppercase tracking-wide font-semibold">Jam Buka</p>
                            <p class="font-medium leading-snug">{{ $operatingHours }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 uppercase tracking-wide font-semibold">Pembayaran</p>
                            <p class="font-medium leading-snug">{{ $paymentMethods }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 flex-shrink-0 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 uppercase tracking-wide font-semibold">Jaminan</p>
                            <p class="font-medium leading-snug">100% Original & Trusted</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Column 2: Navigation -->
            <div class="space-y-3">
                <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100">Navigasi</h4>
                <ul class="space-y-2 text-xs text-gray-600 dark:text-gray-400 font-medium">
                    <li>
                        <a href="#tentang" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors inline-flex items-center gap-2 hover:opacity-80">
                            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21V12h6v9" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing.products.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors inline-flex items-center gap-2 hover:opacity-80">
                            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                            Catalog
                        </a>
                    </li>
                    <li>
                        <a href="#tentang-kami" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors inline-flex items-center gap-2 hover:opacity-80">
                            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Tentang Kami
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->isCustomer())
                            <li>
                                <a href="{{ route('profile') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors inline-flex items-center gap-2">
                                    <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="4"/></svg>
                                    Profil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('landing.orders.history') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors inline-flex items-center gap-2">
                                    <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    Riwayat Order
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors inline-flex items-center gap-2">
                                    <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    Dashboard
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
            
            <!-- Column 3: Contact -->
            <div class="space-y-3">
                <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100">Kontak Kami</h4>
                <div class="space-y-2.5 text-xs">
                    @if($shopEmail)
                    <a href="mailto:{{ $shopEmail }}" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        <svg class="w-4 h-4 flex-shrink-0 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 uppercase tracking-wide font-semibold">Email</p>
                            <p class="font-medium leading-snug break-all">{{ $shopEmail }}</p>
                        </div>
                    </a>
                    @endif
                    
                    @if($shopPhone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $shopPhone) }}" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                        <svg class="w-4 h-4 flex-shrink-0 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 uppercase tracking-wide font-semibold">WhatsApp</p>
                            <p class="font-medium leading-snug">{{ $shopPhone }}</p>
                        </div>
                    </a>
                    @endif
                    
                    @if($shopAddress)
                    <a href="{{ $shopMapsUrl ?? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($shopAddress) }}" target="_blank" rel="noopener noreferrer" class="group flex items-start gap-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <svg class="w-4 h-4 flex-shrink-0 text-blue-500 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] text-gray-500 dark:text-gray-500 uppercase tracking-wide font-semibold">Alamat</p>
                            <p class="font-medium leading-snug">{{ $shopLocationName ?? $shopAddress }}</p>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-500 dark:text-gray-400 text-center sm:text-left">
                    &copy; {{ date('Y') }} {{ $shopName }}. All rights reserved. Made with ❤️ for thrift lovers.
                </p>
                <div class="flex items-center gap-1.5 text-[9px] text-gray-400 dark:text-gray-600">
                    <span>Powered by</span>
                    <span class="font-medium text-red-500/80">Laravel</span>
                    <span>&</span>
                    <span class="font-medium text-indigo-500/80 dark:text-indigo-400/80">PHP</span>
                </div>
            </div>
        </div>
    </div>
</footer>
