<x-clean-layout>
    @php
        $user = auth()->user();
        $homeUrl = $user?->homePath() ?? url('/');
        $initial = strtoupper(substr($user?->name ?? 'U', 0, 1));
        $cards = [
            [
                'show' => true,
                'route' => route('profile.info'),
                'label' => 'Informasi akun',
                'description' => 'Update nama, email, WhatsApp, dan password.',
                'tone' => 'bg-slate-950 text-white',
                'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            ],
            [
                'show' => $user?->isCustomer(),
                'route' => route('profile.address'),
                'label' => 'Alamat pengiriman',
                'description' => 'Alamat default untuk checkout dan pengiriman.',
                'tone' => 'bg-emerald-50 text-emerald-700',
                'icon' => 'M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',
            ],
            [
                'show' => $user?->isCustomer(),
                'route' => route('profile.history'),
                'label' => 'Riwayat order',
                'description' => 'Pantau status order dan lanjutkan pembayaran.',
                'tone' => 'bg-amber-50 text-amber-700',
                'icon' => 'M9 5h6M9 9h6M9 13h3M5 3h14v18l-7-3-7 3V3z',
            ],
            [
                'show' => true,
                'route' => route('profile.logout'),
                'label' => 'Keluar akun',
                'description' => 'Logout dari perangkat ini.',
                'tone' => 'bg-red-50 text-red-700',
                'icon' => 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-[#f7faf9] px-4 py-5 text-slate-950 sm:px-6 lg:px-8 lg:py-10">
        <div class="mx-auto max-w-5xl">
            <header class="flex items-center justify-between gap-3 rounded-[1.75rem] border border-slate-200 bg-white/95 p-3 shadow-[0_18px_60px_rgba(15,23,42,0.06)] backdrop-blur-xl sm:p-4">
                <a href="{{ $homeUrl }}" class="inline-flex min-h-11 items-center gap-3 rounded-2xl px-2 text-sm font-extrabold text-slate-700 transition hover:bg-slate-50 hover:text-slate-950" aria-label="Kembali ke beranda">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Beranda
                </a>

                <div class="flex items-center gap-3 text-right">
                    <div class="hidden leading-tight sm:block">
                        <p class="text-sm font-extrabold tracking-tight text-slate-950">{{ $user?->name }}</p>
                        <p class="text-xs font-semibold text-slate-500">{{ $user?->email }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-sm font-black text-white shadow-lg shadow-slate-950/15">
                        {{ $initial }}
                    </div>
                </div>
            </header>

            <section class="grid gap-6 py-8 lg:grid-cols-[minmax(0,0.85fr)_minmax(360px,1fr)] lg:items-start lg:py-12">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500 shadow-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Akun pembeli
                    </p>
                    <h1 class="mt-5 text-4xl font-extrabold leading-[0.98] tracking-[-0.05em] text-slate-950 sm:text-5xl lg:text-6xl">
                        Semua detail belanja dalam satu akun.
                    </h1>
                    <p class="mt-4 max-w-md text-sm font-medium leading-7 text-slate-600 sm:text-base sm:leading-8">
                        Atur data profil, alamat utama, dan riwayat order supaya proses belanja thrift tetap jelas.
                    </p>
                </div>

                <div class="grid gap-3">
                    @foreach($cards as $card)
                        @if($card['show'])
                            <a href="{{ $card['route'] }}" class="group flex items-center gap-4 rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-[0_18px_50px_rgba(15,23,42,0.08)]">
                                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $card['tone'] }}">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                                    </svg>
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block text-base font-extrabold tracking-tight text-slate-950">{{ $card['label'] }}</span>
                                    <span class="mt-1 block text-sm font-medium leading-6 text-slate-500">{{ $card['description'] }}</span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 text-slate-300 transition group-hover:translate-x-0.5 group-hover:text-slate-950" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-clean-layout>
