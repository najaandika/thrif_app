<section class="grid gap-12 pt-4 sm:pt-6 lg:pt-10" id="tentang" data-animate data-section="hero">
    <div class="space-y-8 md:space-y-10">
        <div class="space-y-5 sm:space-y-6 max-w-3xl">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-gray-900 dark:text-gray-100 leading-[1.2] sm:leading-[1.25]">
                Koleksi thrift pilihan untuk lemari kamu.
            </h1>
            <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 leading-relaxed sm:pl-1">
                Setiap item kami kurasi satu per satu, difoto apa adanya, dan siap dikirim cepat ke kota kamu. Fokus kami: bikin pengalaman thrifting online senyaman mungkin untuk customer.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-4">
            @auth
                <a href="#produk" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/40 hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:ring-indigo-500">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M15 11l-3-3m0 0l-3 3m3-3v8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 12h18M3 6h18M3 18h18" stroke-linecap="round"/>
                    </svg>
                    Lihat etalase terbaru
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/40 hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:ring-indigo-500">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Masuk untuk order & pantau stok
                </a>
                <p class="text-xs text-gray-500 dark:text-gray-400 max-w-xs">✨ Belum punya akun? Daftar lewat menu atas sebelum checkout.</p>
            @endauth
        </div>

        <div class="grid gap-4 sm:grid-cols-2 pt-6 sm:pt-8 border-t border-gray-100 dark:border-gray-800/60">
            <div class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/70 p-4 space-y-3">
                <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-200">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 7h16M4 12h10M4 17h6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <p class="text-xs font-semibold tracking-[0.18em] text-gray-400 uppercase">Kurasi asli</p>
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Dipilih & dicek manual</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kami pastikan kondisi layak pakai: detail ukuran, noda, dan tekstur dijelaskan sebelum kamu checkout.</p>
            </div>
            <div class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/70 p-4 space-y-3">
                <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-200">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 4h5l2 5h9" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="9" cy="19" r="1.5" />
                        <circle cx="18" cy="19" r="1.5" />
                    </svg>
                </div>
                <p class="text-xs font-semibold tracking-[0.18em] text-gray-400 uppercase">Untuk customer</p>
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Pengiriman fleksibel</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Bisa pilih ekspedisi favoritmu, kami bantu packing rapi dan kirim update resi lewat WhatsApp.</p>
            </div>
        </div>
    </div>

</section>

<section class="mt-20 md:mt-24" aria-label="Etalase produk terbaru">
    @include('landing.sections.product-showcase', [
        'featuredProducts' => $featuredProducts,
        'hasMoreProducts' => $hasMoreProducts,
    ])
</section>
