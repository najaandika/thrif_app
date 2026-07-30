@php
    $whatsappNumber = $shopPhone ? preg_replace('/[^0-9]/', '', $shopPhone) : null;
    $instagramHandle = $socialInstagram ? '@' . ltrim(trim(parse_url($socialInstagram, PHP_URL_PATH) ?: 'instagram', '/'), '@') : null;
    $tiktokHandle = $socialTiktok ? '@' . ltrim(trim(parse_url($socialTiktok, PHP_URL_PATH) ?: 'tiktok', '/'), '@') : null;
@endphp

<section class="h-full rounded-[1.5rem] border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900 sm:p-6 lg:p-7" id="kontak" data-section="contact">
    <div class="notion-caption mb-5"><span></span>Official channels</div>
    <div class="flex items-start justify-between gap-5">
        <div class="max-w-md">
            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Kontak resmi</p>
            <h2 class="mt-2 text-2xl font-semibold leading-tight tracking-tight text-gray-950 dark:text-gray-50">Butuh detail ukuran atau stok? Hubungi dari sini.</h2>
        </div>
        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-gray-200 bg-gray-50 text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200" aria-hidden="true">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 8.5v7a2.5 2.5 0 01-2.5 2.5H8l-5 3V5.5A2.5 2.5 0 015.5 3h13A2.5 2.5 0 0121 5.5v3z" />
            </svg>
        </div>
    </div>

    <p class="mt-5 text-sm leading-7 text-gray-600 dark:text-gray-300">Gunakan channel berikut untuk konfirmasi kondisi barang, request detail foto, atau menanyakan status pesanan.</p>

    <div class="mt-6 space-y-3 text-sm">
        @if($shopPhone)
            <a href="https://wa.me/{{ $whatsappNumber }}" class="group flex items-center justify-between gap-4 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition hover:border-teal-200 hover:bg-teal-50/60 dark:border-gray-800 dark:bg-gray-950 dark:hover:border-teal-900 dark:hover:bg-teal-950/30">
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-500 dark:text-gray-400">WhatsApp</p>
                    <p class="mt-1 truncate font-semibold text-gray-950 dark:text-gray-100">{{ $shopPhone }}</p>
                </div>
                <svg class="h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-0.5 group-hover:text-teal-700 dark:group-hover:text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif

        @if($socialInstagram)
            <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between gap-4 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition hover:border-gray-300 hover:bg-gray-100 dark:border-gray-800 dark:bg-gray-950 dark:hover:bg-gray-800">
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-500 dark:text-gray-400">Instagram</p>
                    <p class="mt-1 truncate font-semibold text-gray-950 dark:text-gray-100">{{ $instagramHandle }}</p>
                </div>
                <svg class="h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif

        @if($socialTiktok)
            <a href="{{ $socialTiktok }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between gap-4 rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition hover:border-gray-300 hover:bg-gray-100 dark:border-gray-800 dark:bg-gray-950 dark:hover:bg-gray-800">
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-500 dark:text-gray-400">TikTok</p>
                    <p class="mt-1 truncate font-semibold text-gray-950 dark:text-gray-100">{{ $tiktokHandle }}</p>
                </div>
                <svg class="h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif

        @guest
            <div class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-3.5 shadow-sm dark:border-gray-800 dark:bg-gray-950">
                <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-700 dark:bg-gray-900 dark:text-gray-300" aria-hidden="true">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4m-1 0h10a2 2 0 012 2v5a2 2 0 01-2 2H7a2 2 0 01-2-2v-5a2 2 0 012-2z" />
                    </svg>
                </span>
                <p class="text-xs font-medium leading-5 text-gray-600 dark:text-gray-300">
                    <span class="font-semibold text-gray-950 dark:text-gray-100">Masuk</span> untuk checkout lebih cepat, simpan alamat, dan pantau pesanan.
                </p>
            </div>
        @endguest
    </div>
</section>
