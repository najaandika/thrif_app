@php
    $whatsappNumber = $shopPhone ? preg_replace('/[^0-9]/', '', $shopPhone) : null;
@endphp

<footer class="mt-3 border-t border-gray-200 bg-white">
    <div class="mx-auto max-w-6xl px-4 pb-28 pt-8 sm:px-6 sm:pb-28 sm:pt-10 lg:px-8 lg:py-10">
        <div class="grid gap-8 lg:grid-cols-[1.35fr_0.7fr_1fr] lg:gap-12">
            <div>
                <div class="flex items-center gap-3">
                    @if($shopLogo)
                        <img src="{{ media_url($shopLogo) }}" alt="{{ $shopName }}" width="44" height="44" loading="lazy" class="h-11 w-11 shrink-0 rounded-2xl object-cover ring-1 ring-gray-200">
                    @else
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gray-950 text-sm font-semibold text-white">
                            {{ strtoupper(substr($shopName, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold text-gray-950">{{ $shopName }}</p>
                        <p class="mt-0.5 text-xs font-medium text-gray-500">Curated preloved goods</p>
                    </div>
                </div>

                <p class="mt-5 max-w-md text-sm leading-7 text-gray-600">
                    {{ $shopTagline }}
                </p>

                <div class="mt-5 grid gap-3 border-t border-gray-200 pt-5 text-xs sm:grid-cols-3">
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3">
                        <p class="font-semibold uppercase tracking-[0.14em] text-gray-400">Jam buka</p>
                        <p class="mt-1 font-semibold leading-5 text-gray-900">{{ $operatingHours }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3">
                        <p class="font-semibold uppercase tracking-[0.14em] text-gray-400">Pembayaran</p>
                        <p class="mt-1 font-semibold leading-5 text-gray-900">{{ $paymentMethods }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3">
                        <p class="font-semibold uppercase tracking-[0.14em] text-gray-400">Jaminan</p>
                        <p class="mt-1 font-semibold leading-5 text-gray-900">Original & trusted</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-500">Navigasi</h3>
                <nav class="mt-4 grid grid-cols-2 gap-3 text-sm font-semibold text-gray-800 sm:grid-cols-1">
                    <a href="{{ route('landing.home') }}" class="transition hover:text-teal-700">Home</a>
                    <a href="{{ route('landing.products.index') }}" class="transition hover:text-teal-700">Katalog</a>
                    <a href="{{ route('landing.products.index', ['promo' => 1]) }}" class="inline-flex items-center gap-2 text-red-600 transition hover:text-red-700"><span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>Flash Sale</a>
                    <a href="#tentang-kami" class="transition hover:text-teal-700">Tentang</a>
                    <a href="#kontak" class="transition hover:text-teal-700">Kontak</a>
                    @auth
                        @if(auth()->user()->isCustomer())
                            <a href="{{ route('landing.orders.history') }}" class="transition hover:text-teal-700">Riwayat order</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="transition hover:text-teal-700">Dashboard</a>
                        @endif
                    @endauth
                </nav>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-500">Kontak</h3>
                <div class="mt-4 space-y-4 text-sm text-gray-600">
                    @if($shopPhone)
                        <a href="https://wa.me/{{ $whatsappNumber }}" class="block transition hover:text-teal-700">
                            <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-400">WhatsApp</span>
                            <span class="mt-1 block font-semibold text-gray-900">{{ $shopPhone }}</span>
                        </a>
                    @endif

                    @if($shopEmail)
                        <a href="mailto:{{ $shopEmail }}" class="block transition hover:text-teal-700">
                            <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-400">Email</span>
                            <span class="mt-1 block break-all font-semibold text-gray-900">{{ $shopEmail }}</span>
                        </a>
                    @endif

                    @if($shopAddress)
                        <a href="{{ $shopMapsUrl ?? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($shopAddress) }}" target="_blank" rel="noopener noreferrer" class="block transition hover:text-teal-700">
                            <span class="block text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-400">Alamat</span>
                            <span class="mt-1 block font-semibold leading-6 text-gray-900">{{ $shopLocationName ?? $shopAddress }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-3 border-t border-gray-200 pt-5 text-xs text-gray-500 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} {{ $shopName }}. All rights reserved.</p>
            <p class="font-medium text-gray-600">Preloved curated, stok real-time, siap checkout.</p>
        </div>
    </div>
</footer>


