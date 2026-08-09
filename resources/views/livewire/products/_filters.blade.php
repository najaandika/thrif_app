<div class="mb-5 grid gap-3">
    <div class="grid gap-3">
        <label for="product_search" class="relative block">
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
                </svg>
            </span>
            <input
                wire:model.live.debounce.300ms="search"
                id="product_search"
                name="product_search"
                type="search"
                autocomplete="off"
                placeholder="Cari nama, kategori, ukuran, atau deskripsi"
                class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/70 pl-12 pr-4 text-sm font-bold text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-slate-950 focus:bg-white focus:ring-4 focus:ring-slate-200"
            >
        </label>
    </div>

    <div class="grid gap-3 xl:grid-cols-[1fr_1fr_1fr_auto]">
        <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-1">
            <div class="grid grid-cols-3 gap-1">
                @foreach (['all' => 'Semua', 'ready' => 'Ready', 'sold' => 'Terjual'] as $value => $label)
                    <button type="button" wire:click="$set('availability', '{{ $value }}')" class="rounded-xl px-3 py-2.5 text-xs font-extrabold transition {{ $availability === $value ? 'bg-slate-950 text-white shadow-sm' : 'text-slate-500 hover:bg-white hover:text-slate-950' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-1">
            <div class="grid grid-cols-3 gap-1">
                @foreach (['all' => 'Semua', 'sale' => 'Aktif', 'regular' => 'Normal'] as $value => $label)
                    <button type="button" wire:click="$set('promo', '{{ $value }}')" class="rounded-xl px-3 py-2.5 text-xs font-extrabold transition {{ $promo === $value ? 'bg-red-600 text-white shadow-sm' : 'text-slate-500 hover:bg-white hover:text-slate-950' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-1">
            <div class="grid grid-cols-4 gap-1">
                @foreach (['latest' => 'Baru', 'price_low' => 'Murah', 'price_high' => 'Mahal', 'discount' => 'Diskon'] as $value => $label)
                    <button type="button" wire:click="$set('sort', '{{ $value }}')" class="rounded-xl px-2 py-2.5 text-xs font-extrabold transition {{ $sort === $value ? 'bg-white text-slate-950 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:bg-white hover:text-slate-950' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        <div x-data="{ open: false }" class="relative">
            <button type="button" @click="open = ! open" @keydown.escape.window="open = false" class="flex h-full min-h-12 w-full items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-extrabold text-slate-700 shadow-sm transition hover:border-slate-300 hover:text-slate-950 xl:min-w-56">
                <span class="truncate">{{ $category ?: 'Semua kategori' }}</span>
                <svg class="h-4 w-4 text-slate-400 transition" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="m6 9 6 6 6-6" />
                </svg>
            </button>

            <div x-cloak x-show="open" x-transition.origin.top.right @click.outside="open = false" class="absolute right-0 z-30 mt-2 w-full min-w-64 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl shadow-slate-950/15">
                <button type="button" wire:click="$set('category', '')" @click="open = false" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-extrabold transition {{ $category === '' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}">
                    Semua kategori
                    @if($category === '')<span class="h-2 w-2 rounded-full bg-white"></span>@endif
                </button>

                <div class="mt-1 max-h-72 overflow-y-auto pr-1">
                    @foreach($categories as $cat)
                        <button type="button" wire:click="$set('category', @js($cat->name))" @click="open = false" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-extrabold transition {{ $category === $cat->name ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}">
                            <span class="truncate">{{ $cat->name }}</span>
                            @if($category === $cat->name)<span class="h-2 w-2 rounded-full bg-white"></span>@endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
