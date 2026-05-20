@guest
    <div id="login-required-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" data-close-modal></div>
        <div class="relative flex items-center justify-center min-h-screen px-4">
            <div class="w-full max-w-md rounded-3xl bg-white dark:bg-gray-900 shadow-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800" style="background-color: #0f172a;">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold" style="color: #ffffff;">Login dulu yuk</h3>
                            <p class="text-xs mt-0.5" style="color: #cbd5e1;">Akses penuh menunggumu</p>
                        </div>
                        <button type="button" class="transition-colors" style="color: rgba(255,255,255,0.8);" data-close-modal aria-label="Tutup">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 space-y-5">
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="h-5 w-5 flex-shrink-0 mt-0.5" style="color: #047857;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Lihat stok real-time & detail produk lengkap</span>
                        </div>
                        <div class="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="h-5 w-5 flex-shrink-0 mt-0.5" style="color: #047857;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Checkout cepat dengan alamat tersimpan</span>
                        </div>
                        <div class="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-300">
                            <svg class="h-5 w-5 flex-shrink-0 mt-0.5" style="color: #047857;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Pantau riwayat pembelian & status kirim</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 pt-2">
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold shadow-md transition-all hover:opacity-90"
                           style="background-color: #047857; color: #ffffff;">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Masuk Sekarang
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200 transition-all hover:border-gray-400 dark:hover:border-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Buat Akun Baru
                            </a>
                        @endif
                    </div>
                    <p class="text-[11px] text-center text-gray-500 dark:text-gray-400 pt-2">
                        Gratis & cepat, cuma butuh email dan password
                    </p>
                </div>
            </div>
        </div>
    </div>


@endguest
