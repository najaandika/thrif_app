@guest
    <div id="login-required-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-950/55 backdrop-blur-md" data-close-modal></div>
        <div class="relative flex min-h-screen items-center justify-center px-4 py-8">
            <div class="w-full max-w-[30rem] overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_28px_80px_rgba(15,23,42,0.24)]">
                <div class="relative border-b border-slate-100 px-6 py-5">
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-slate-950 via-emerald-500 to-red-500"></div>
                    <div class="flex items-start justify-between gap-5">
                        <div class="space-y-2">
                            <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-500">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Akun pembeli
                            </span>
                            <div>
                                <h3 class="text-2xl font-black tracking-tight text-slate-950">Masuk untuk lanjut.</h3>
                                <p class="mt-1 text-sm font-medium leading-6 text-slate-500">Simpan alamat, checkout lebih cepat, dan pantau order dari satu tempat.</p>
                            </div>
                        </div>
                        <button type="button" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950" data-close-modal aria-label="Tutup">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="space-y-5 p-6">
                    <div class="grid gap-2.5">
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                            <svg class="h-5 w-5 flex-shrink-0 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Detail produk dan stok tetap jelas</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                            <svg class="h-5 w-5 flex-shrink-0 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Checkout cepat dengan data tersimpan</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                            <svg class="h-5 w-5 flex-shrink-0 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Riwayat order mudah dicek lagi</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 pt-1">
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 py-4 text-sm font-extrabold text-white shadow-[0_18px_36px_rgba(15,23,42,0.24)] transition hover:-translate-y-0.5 hover:bg-slate-900">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Masuk sekarang
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-bold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Buat akun baru
                            </a>
                        @endif
                    </div>
                    <p class="pt-1 text-center text-[11px] font-semibold text-slate-400">
                        Gratis, cepat, dan aman untuk checkout thrift.
                    </p>
                </div>
            </div>
        </div>
    </div>


@endguest



