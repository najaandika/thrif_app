<div class="bg-[#f7faf9] text-slate-950">
    <div class="mx-auto max-w-7xl px-4 pb-28 pt-5 sm:px-6 lg:px-8 lg:pb-16 lg:pt-8">
        <header class="mb-6 rounded-[1.75rem] border border-slate-200 bg-white/90 p-3 shadow-[0_18px_60px_rgba(15,23,42,0.06)] backdrop-blur-xl sm:p-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('landing.home') }}" class="inline-flex min-w-0 items-center gap-3 rounded-2xl pr-3 transition hover:bg-slate-50" aria-label="Kembali ke home">
                    @php($shopLogo = \App\Models\Setting::get('shop_logo'))
                    @php($shopName = \App\Models\Setting::get('shop_name', 'Mr Crab Shop'))
                    @if($shopLogo)
                        <img src="{{ media_url($shopLogo) }}" alt="{{ $shopName }}" class="h-11 w-11 shrink-0 rounded-2xl object-cover ring-1 ring-slate-200">
                    @else
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-slate-950 text-sm font-black text-white">M</span>
                    @endif
                    <span class="min-w-0">
                        <span class="block truncate text-sm font-black tracking-tight text-slate-950">{{ $shopName }}</span>
                        <span class="block truncate text-[11px] font-semibold text-slate-500">Katalog curated preloved</span>
                    </span>
                </a>
</div>
        </header>

        <section class="mb-6 grid gap-5 lg:grid-cols-[minmax(0,0.9fr)_minmax(360px,0.45fr)] lg:items-end">
            <div>
                <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-black uppercase tracking-[0.16em] text-slate-500 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                    Etalase thrift
                </p>
                <h1 class="mt-4 max-w-3xl text-4xl font-black leading-[0.95] tracking-[-0.055em] text-slate-950 sm:text-5xl lg:text-6xl">
                    Pilih item yang kondisinya jelas.
                </h1>
                <p class="mt-4 max-w-2xl text-sm font-medium leading-7 text-slate-600 sm:text-base">
                    Cari berdasarkan nama, kategori, ukuran, atau pilih promo aktif. Semua item yang tampil masih bisa dipesan.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-[0_18px_50px_rgba(15,23,42,0.05)]">
                <div class="grid grid-cols-3 divide-x divide-slate-100 text-center">
                    <div class="px-2">
                        <p class="text-[10px] font-black uppercase tracking-[0.14em] text-slate-400">Produk</p>
                        <p class="mt-1 text-lg font-black text-slate-950">{{ $products->total() }}</p>
                    </div>
                    <div class="px-2">
                        <p class="text-[10px] font-black uppercase tracking-[0.14em] text-slate-400">Promo</p>
                        <p class="mt-1 text-lg font-black text-red-600">{{ $promo ? 'Aktif' : 'Ada' }}</p>
                    </div>
                    <div class="px-2">
                        <p class="text-[10px] font-black uppercase tracking-[0.14em] text-slate-400">Stok</p>
                        <p class="mt-1 text-lg font-black text-emerald-700">Ready</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative z-20 mb-6 rounded-[1.5rem] border border-slate-200 bg-white/95 p-3 shadow-[0_16px_50px_rgba(15,23,42,0.08)] backdrop-blur-xl" x-data="{ open: false }">
            <div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_190px_48px] lg:items-center">
                <label class="relative block">
                    <span class="sr-only">Cari produk</span>
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input
                        type="search"
                        id="catalog_search"
                        name="catalog_search"
                        autocomplete="off"
                        wire:model.live.debounce.650ms="search"
                        placeholder="Cari item, kategori, atau size"
                        class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm font-bold text-slate-950 outline-none placeholder:text-slate-400 transition focus:border-slate-950 focus:bg-white focus:ring-4 focus:ring-slate-950/10"
                        aria-label="Cari produk"
                    >
                </label>

                <div class="relative" x-data="{ sortOpen: false }">
                    <button
                        type="button"
                        @click="sortOpen = !sortOpen"
                        class="flex h-12 w-full items-center justify-between rounded-2xl border border-slate-200 bg-white px-4 text-sm font-black text-slate-700 outline-none transition hover:border-slate-300 hover:bg-slate-50 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10"
                        aria-label="Urutkan produk"
                    >
                        <span>
                            @switch($sort)
                                @case('price_low') Harga rendah @break
                                @case('price_high') Harga tinggi @break
                                @case('discount') Diskon terbesar @break
                                @default Terbaru
                            @endswitch
                        </span>
                        <svg class="h-4 w-4 text-slate-400 transition" :class="sortOpen ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <div
                        x-show="sortOpen"
                        x-cloak
                        @click.outside="sortOpen = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-[0.98]"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-[0.98]"
                        class="absolute left-0 right-0 top-full z-50 mt-2 overflow-hidden rounded-2xl border border-slate-200 bg-white p-1.5 shadow-2xl shadow-slate-950/12"
                    >
                        <button type="button" wire:click="$set('sort', 'latest')" @click="sortOpen = false" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-black transition {{ $sort === 'latest' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}">
                            Terbaru
                            @if($sort === 'latest')<span class="h-2 w-2 rounded-full bg-white"></span>@endif
                        </button>
                        <button type="button" wire:click="$set('sort', 'price_low')" @click="sortOpen = false" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-black transition {{ $sort === 'price_low' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}">
                            Harga rendah
                            @if($sort === 'price_low')<span class="h-2 w-2 rounded-full bg-white"></span>@endif
                        </button>
                        <button type="button" wire:click="$set('sort', 'price_high')" @click="sortOpen = false" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-black transition {{ $sort === 'price_high' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}">
                            Harga tinggi
                            @if($sort === 'price_high')<span class="h-2 w-2 rounded-full bg-white"></span>@endif
                        </button>
                        <button type="button" wire:click="$set('sort', 'discount')" @click="sortOpen = false" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm font-black transition {{ $sort === 'discount' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}">
                            Diskon terbesar
                            @if($sort === 'discount')<span class="h-2 w-2 rounded-full bg-white"></span>@endif
                        </button>
                    </div>
                </div>

                <button
                    type="button"
                    @click="open = !open"
                    class="inline-flex h-12 items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 text-sm font-black text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950"
                    aria-label="Buka filter"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M4 7h16M7 12h10M10 17h4" stroke-linecap="round" />
                    </svg>
                    <span class="lg:hidden">Filter</span>
                </button>
            </div>

            <div
                x-show="open"
                x-cloak
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="absolute left-3 right-3 top-full mt-3 overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-2xl shadow-slate-950/12 lg:left-auto lg:w-80"
            >
                <div class="border-b border-slate-100 p-3">
                    <p class="px-2 text-[10px] font-black uppercase tracking-[0.16em] text-slate-400">Status</p>
                    <div class="mt-2 grid gap-1">
                        <button type="button" wire:click="resetFilters" @click="open = false" class="flex items-center justify-between rounded-2xl px-3 py-2 text-left text-sm font-bold transition {{ !$promo && $category === '' && $search === '' ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}">
                            Semua produk
                            <span class="h-2 w-2 rounded-full {{ !$promo && $category === '' && $search === '' ? 'bg-white' : 'bg-slate-200' }}"></span>
                        </button>
                        <button type="button" wire:click="togglePromo" @click="open = false" class="flex items-center justify-between rounded-2xl px-3 py-2 text-left text-sm font-bold transition {{ $promo ? 'bg-red-600 text-white' : 'text-slate-600 hover:bg-red-50 hover:text-red-600' }}">
                            Flash Sale
                            <span class="h-2 w-2 rounded-full {{ $promo ? 'bg-white' : 'bg-red-200' }}"></span>
                        </button>
                    </div>
                </div>

                <div class="max-h-72 overflow-y-auto p-3">
                    <p class="px-2 text-[10px] font-black uppercase tracking-[0.16em] text-slate-400">Kategori</p>
                    <div class="mt-2 grid gap-1">
                        @foreach($categories as $slug => $name)
                            <button
                                type="button"
                                wire:click="$set('category', '{{ $category === $slug ? '' : $slug }}')"
                                @click="open = false"
                                class="flex items-center justify-between rounded-2xl px-3 py-2 text-left text-sm font-bold transition {{ $category === $slug ? 'bg-slate-950 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-950' }}"
                            >
                                <span class="truncate">{{ $name }}</span>
                                <span class="h-2 w-2 shrink-0 rounded-full {{ $category === $slug ? 'bg-white' : 'bg-slate-200' }}"></span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @if($promo || $category || $search || $sort !== 'latest')
            <div class="mb-5 flex flex-wrap items-center gap-2 text-xs font-black">
                @if($search)
                    <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-slate-600">Cari: {{ $search }}</span>
                @endif
                @if($promo)
                    <span class="inline-flex items-center gap-2 rounded-full bg-red-600 px-3 py-1.5 text-white">Flash Sale <button type="button" wire:click="$set('promo', false)" aria-label="Hapus filter promo">&times;</button></span>
                @endif
                @if($category)
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-3 py-1.5 text-white">{{ $category }} <button type="button" wire:click="$set('category', '')" aria-label="Hapus filter kategori">&times;</button></span>
                @endif
                @if($sort !== 'latest')
                    <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-slate-600">Urutan aktif</span>
                @endif
                <button type="button" wire:click="resetFilters" class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-slate-500 transition hover:border-slate-300 hover:text-slate-950">Reset</button>
            </div>
        @endif

        @if($products->count())
            <div wire:loading.delay.class="opacity-60" wire:target="search,sort,category,promo,resetFilters,togglePromo" class="grid grid-cols-2 gap-3 transition-opacity sm:gap-4 md:grid-cols-3 xl:grid-cols-4">
                @foreach($products as $product)
                    <article wire:key="catalog-product-{{ $product->id }}" class="group overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-2xl hover:shadow-slate-950/10" data-product-card data-product-name="{{ strtolower($product->name) }}" data-product-category="{{ $product->category }}" data-product-price="{{ rupiah($product->final_price) }}" data-product-image="{{ $product->image ? media_url($product->image) : '' }}">
                        <a href="{{ route('landing.products.show', ['product' => $product, 'from' => 'catalog']) }}" class="block" aria-label="Lihat detail {{ $product->name }}">
                            <div class="relative aspect-[4/5] overflow-hidden bg-slate-100">
                                @if($product->image)
                                    <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-xs font-bold text-slate-400">No Image</div>
                                @endif

                                <div class="absolute left-2 top-2 flex flex-wrap gap-1.5">
                                    <span class="rounded-full border border-white/80 bg-white/90 px-2.5 py-1 text-[10px] font-black shadow-sm backdrop-blur" style="color: {{ $product->condition_color }};">{{ $product->condition_label }}</span>
                                </div>

                                @if($product->is_on_sale)
                                    <span class="absolute right-2 top-2 rounded-full bg-red-600 px-2.5 py-1 text-[10px] font-black text-white shadow-sm">-{{ $product->discount_percent }}%</span>
                                @endif
                            </div>
                        </a>

                        <div class="grid gap-3 p-3 sm:p-4">
                            <a href="{{ route('landing.products.show', ['product' => $product, 'from' => 'catalog']) }}" class="block">
                                <p class="line-clamp-2 min-h-[2.5rem] text-sm font-black leading-snug tracking-tight text-slate-950 transition group-hover:text-slate-700">{{ Str::title($product->name) }}</p>
                                <div class="mt-2 flex flex-wrap gap-1.5 text-[10px] font-black uppercase tracking-[0.12em] text-slate-400">
                                    @if($product->category)<span>{{ $product->category }}</span>@endif
                                    @if($product->size)<span>Size {{ $product->size }}</span>@endif
                                </div>
                            </a>

                            <div class="flex items-end justify-between gap-2">
                                <div class="min-w-0">
                                    @if($product->is_on_sale)
                                        <p class="text-[11px] font-semibold text-slate-400 line-through">{{ rupiah($product->price) }}</p>
                                        <p class="text-sm font-black text-red-600 sm:text-base">{{ rupiah($product->final_price) }}</p>
                                    @else
                                        <p class="text-sm font-black text-slate-950 sm:text-base">{{ rupiah($product->price) }}</p>
                                    @endif
                                </div>

                                @if($product->is_available)
                                    @auth
                                        <form action="{{ route('landing.cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" aria-label="Tambah {{ $product->name }} ke keranjang" class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-lg shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                    <circle cx="9" cy="21" r="1" />
                                                    <circle cx="20" cy="21" r="1" />
                                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" data-requires-login aria-label="Masuk untuk menambah {{ $product->name }} ke keranjang" class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-lg shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <circle cx="9" cy="21" r="1" />
                                                <circle cx="20" cy="21" r="1" />
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-8 rounded-[1.5rem] border border-slate-200 bg-white px-4 py-3 shadow-sm">
                {{ $products->links() }}
            </div>
        @else
            <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white px-6 py-14 text-center shadow-sm">
                <p class="text-sm font-black uppercase tracking-[0.16em] text-slate-400">Tidak ditemukan</p>
                <h2 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950">Belum ada item yang cocok.</h2>
                <p class="mx-auto mt-3 max-w-md text-sm font-medium leading-7 text-slate-500">Coba hapus filter, cari kategori lain, atau lihat semua produk yang masih ready.</p>
                <button type="button" wire:click="resetFilters" class="mt-6 inline-flex h-11 items-center justify-center rounded-2xl bg-slate-950 px-5 text-sm font-black text-white transition hover:bg-slate-800">Reset katalog</button>
            </div>
        @endif
    </div>
</div>






