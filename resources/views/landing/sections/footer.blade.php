<footer class="mt-3 border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-950">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[1.4fr_0.8fr_1fr]">
            <div>
                <div class="flex items-center gap-3">
                    @if($shopLogo)
                        <img src="{{ media_url($shopLogo) }}" alt="{{ $shopName }}" width="44" height="44" loading="lazy" class="h-11 w-11 shrink-0 rounded-2xl object-cover ring-1 ring-gray-200 dark:ring-gray-800">
                    @else
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gray-950 text-sm font-semibold text-white dark:bg-gray-100 dark:text-gray-950">
                            {{ strtoupper(substr($shopName, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold text-gray-950 dark:text-gray-50">{{ $shopName }}</p>
                        <p class="mt-0.5 text-xs font-medium text-gray-500 dark:text-gray-400">Curated preloved goods</p>
                    </div>
                </div>

                <p class="mt-5 max-w-md text-sm leading-7 text-gray-600 dark:text-gray-300">
                    {{ $shopTagline }}
                </p>

                <div class="mt-6 flex flex-wrap gap-x-5 gap-y-3 border-t border-gray-200 pt-5 text-xs dark:border-gray-800">
                    <div class="min-w-[140px]">
                        <p class="font-semibold uppercase tracking-[0.14em] text-gray-400 dark:text-gray-500">Jam buka</p>
                        <p class="mt-1 font-semibold leading-5 text-gray-900 dark:text-gray-100">{{ $operatingHours }}</p>
                    </div>
                    <div class="min-w-[150px]">
                        <p class="font-semibold uppercase tracking-[0.14em] text-gray-400 dark:text-gray-500">Pembayaran</p>
                        <p class="mt-1 font-semibold leading-5 text-gray-900 dark:text-gray-100">{{ $paymentMethods }}</p>
                    </div>
                    <div class="min-w-[120px]">
                        <p class="font-semibold uppercase tracking-[0.14em] text-gray-400 dark:text-gray-500">Jaminan</p>
                        <p class="mt-1 font-semibold leading-5 text-gray-900 dark:text-gray-100">Original & trusted</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-500 dark:text-gray-400">Navigasi</h3>
                <nav class="mt-4 grid gap-3 text-sm font-semibold text-gray-800 dark:text-gray-200">
                    <a href="{{ route('landing.home') }}" class="transition hover:text-teal-700 dark:hover:text-teal-300">Home</a>
                    <a href="{{ route('landing.products.index') }}" class="transition hover:text-teal-700 dark:hover:text-teal-300">Katalog</a>
                    <a href="#tentang-kami" class="transition hover:text-teal-700 dark:hover:text-teal-300">Tentang</a>
                    <a href="#kontak" class="transition hover:text-teal-700 dark:hover:text-teal-300">Kontak</a>
                    @auth
                        @if(auth()->user()->isCustomer())
                            <a href="{{ route('landing.orders.history') }}" class="transition hover:text-teal-700 dark:hover:text-teal-300">Riwayat order</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="transition hover:text-teal-700 dark:hover:text-teal-300">Dashboard</a>
                        @endif
                    @endauth
                </nav>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-500 dark:text-gray-400">Kontak</h3>
                <div class="mt-4 space-y-4 text-sm text-gray-600 dark:text-gray-300">
                    @if($shopPhone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $shopPhone) }}" class="block transition hover:text-teal-700 dark:hover:text-teal-300">
                            <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-400 dark:text-gray-500">WhatsApp</span>
                            <span class="mt-1 block font-semibold text-gray-900 dark:text-gray-100">{{ $shopPhone }}</span>
                        </a>
                    @endif

                    @if($shopEmail)
                        <a href="mailto:{{ $shopEmail }}" class="block transition hover:text-teal-700 dark:hover:text-teal-300">
                            <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-400 dark:text-gray-500">Email</span>
                            <span class="mt-1 block break-all font-semibold text-gray-900 dark:text-gray-100">{{ $shopEmail }}</span>
                        </a>
                    @endif

                    @if($shopAddress)
                        <a href="{{ $shopMapsUrl ?? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($shopAddress) }}" target="_blank" rel="noopener noreferrer" class="block transition hover:text-teal-700 dark:hover:text-teal-300">
                            <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-400 dark:text-gray-500">Alamat</span>
                            <span class="mt-1 block font-semibold leading-6 text-gray-900 dark:text-gray-100">{{ $shopLocationName ?? $shopAddress }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-col gap-3 border-t border-gray-200 pt-6 text-xs text-gray-500 dark:border-gray-800 dark:text-gray-400 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} {{ $shopName }}. All rights reserved.</p>
            <p class="font-medium">Curated thrift, ready to order.</p>
        </div>
    </div>
</footer>
