@php
    $tabs = [
        'shop' => ['label' => 'Toko', 'desc' => 'Brand dan kontak utama'],
        'social' => ['label' => 'Sosial', 'desc' => 'Channel customer'],
        'operational' => ['label' => 'Operasional', 'desc' => 'Jam dan pembayaran'],
        'about' => ['label' => 'Tentang', 'desc' => 'Copy landing page'],
    ];
@endphp

<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        @if (session()->has('message'))
            <div class="rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-extrabold text-emerald-700 shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-2xl">
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Sistem toko</p>
                <h1 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950 sm:text-4xl">Pengaturan.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Kelola identitas toko, kontak, sosial media, dan copy landing dari satu tempat.
                </p>
            </div>

            <a href="{{ route('landing.home') }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-12 w-fit items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 text-sm font-extrabold text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-100">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7v7m0-7L10 14m-1-9H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4" />
                </svg>
                Lihat website
            </a>
        </section>

        <div class="grid gap-6 xl:grid-cols-[22rem_minmax(0,1fr)]">
            <aside class="space-y-4">
                <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <div class="flex items-center gap-4">
                        @if($shop_logo)
                            <img src="{{ media_url($shop_logo) }}" alt="{{ $shop_name }}" class="h-16 w-16 rounded-3xl object-cover ring-1 ring-slate-200">
                        @else
                            <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-slate-950 text-lg font-black text-white">
                                {{ strtoupper(substr($shop_name ?: 'M', 0, 1)) }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="truncate text-lg font-black tracking-[-0.03em] text-slate-950">{{ $shop_name ?: 'Nama toko' }}</p>
                            <p class="mt-1 line-clamp-2 text-sm font-semibold leading-5 text-slate-500">{{ $shop_tagline ?: 'Tagline toko belum diisi' }}</p>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-2 gap-2 border-t border-slate-100 pt-5">
                        <div class="rounded-2xl bg-slate-50 p-3">
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Kontak</p>
                            <p class="mt-1 truncate text-sm font-black text-slate-950">{{ $shop_phone ?: '-' }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-3">
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Jam</p>
                            <p class="mt-1 truncate text-sm font-black text-slate-950">{{ $operating_hours ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.75rem] border border-slate-200 bg-white p-2 shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <nav class="space-y-1">
                        @foreach($tabs as $key => $tab)
                            <button
                                type="button"
                                wire:click="$set('activeTab', '{{ $key }}')"
                                class="flex w-full items-center justify-between gap-3 rounded-2xl px-4 py-3 text-left transition focus:outline-none focus:ring-4 focus:ring-slate-100 {{ $activeTab === $key ? 'bg-slate-950 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}"
                            >
                                <span>
                                    <span class="block text-sm font-black">{{ $tab['label'] }}</span>
                                    <span class="mt-0.5 block text-xs font-bold {{ $activeTab === $key ? 'text-white/55' : 'text-slate-400' }}">{{ $tab['desc'] }}</span>
                                </span>
                                <span class="h-2 w-2 rounded-full {{ $activeTab === $key ? 'bg-white' : 'bg-slate-200' }}"></span>
                            </button>
                        @endforeach
                    </nav>
                </div>
            </aside>

            <form wire:submit.prevent="save" class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                <div class="border-b border-slate-200 p-5 sm:p-6">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Edit {{ $tabs[$activeTab]['label'] ?? 'Pengaturan' }}</p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">{{ $tabs[$activeTab]['desc'] ?? 'Kelola pengaturan toko' }}</h2>
                </div>

                <div class="p-5 sm:p-6">
                    @if($activeTab === 'shop')
                        @include('livewire.settings.shop')
                    @elseif($activeTab === 'social')
                        @include('livewire.settings.social')
                    @elseif($activeTab === 'operational')
                        @include('livewire.settings.operational')
                    @elseif($activeTab === 'about')
                        @include('livewire.settings.about')
                    @endif
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50/70 p-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-sm font-semibold text-slate-500">Perubahan akan langsung dipakai di landing page setelah disimpan.</p>
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="save"
                        class="inline-flex min-h-[3.1rem] items-center justify-center gap-2 rounded-2xl bg-slate-950 px-6 text-sm font-black text-white shadow-[0_18px_45px_rgba(15,23,42,0.18)] transition hover:-translate-y-0.5 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200 disabled:cursor-not-allowed disabled:bg-slate-300 disabled:text-slate-500 disabled:shadow-none disabled:hover:translate-y-0"
                    >
                        <svg wire:loading.remove wire:target="save" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <svg wire:loading wire:target="save" class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="save">Simpan perubahan</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
