<section class="grid gap-12 pt-6 sm:pt-8 lg:pt-12" id="tentang" data-section="hero">
    @php
        $heroProduct = $featuredProducts->first();
        $supportProducts = $featuredProducts->skip(1)->take(2);
    @endphp

    <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
        <div class="space-y-8">
            <div class="space-y-5 sm:space-y-6 max-w-3xl">
                <span class="inline-flex w-fit items-center rounded-full border border-gray-200 bg-white px-3.5 py-1.5 text-[11px] font-semibold uppercase tracking-[0.16em] text-gray-600 shadow-sm">
                    Curated preloved goods
                </span>
                <h1 class="max-w-4xl text-4xl font-semibold tracking-tight text-gray-950 leading-[1.05] sm:text-5xl lg:text-6xl">
                    Thrift pilihan yang jelas kondisi, ukuran, dan siap checkout.
                </h1>
                <p class="max-w-2xl text-base leading-8 text-gray-600 sm:text-lg">
                    Mr Crab Shop mengkurasi pakaian secondhand satu per satu. Foto dibuat apa adanya, detail produk ditulis ringkas, dan stok hanya ditampilkan saat barang siap dipesan.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                @auth
                    <a href="#produk" class="inline-flex min-h-12 items-center gap-2 rounded-2xl bg-gray-950 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-gray-950/15 transition hover:-translate-y-0.5 hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-950">
                        <span>Lihat etalase</span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @else
                    <a href="#produk" class="inline-flex min-h-12 items-center gap-2 rounded-2xl bg-gray-950 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-gray-950/15 transition hover:-translate-y-0.5 hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-950">
                        <span>Lihat koleksi</span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endauth
            </div>

            <dl class="grid max-w-2xl grid-cols-3 gap-3 border-y border-gray-200 py-5">
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-500">Kondisi</dt>
                    <dd class="mt-1 text-sm font-semibold text-gray-950">Dicek manual</dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-500">Stok</dt>
                    <dd class="mt-1 text-sm font-semibold text-gray-950">Real-time</dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-[0.14em] text-gray-500">Checkout</dt>
                    <dd class="mt-1 text-sm font-semibold text-gray-950">Cepat</dd>
                </div>
            </dl>
        </div>

        <div class="relative lg:pl-6">
            @if ($heroProduct)
                <div class="rounded-[2rem] border border-gray-200 bg-white p-3 shadow-xl shadow-gray-950/5">
                    <a href="{{ route('landing.products.show', ['product' => $heroProduct, 'from' => 'home']) }}" class="group block overflow-hidden rounded-[1.5rem] bg-gray-100">
                        <div class="relative aspect-[4/5] overflow-hidden">
                            @if ($heroProduct->image)
                                <img src="{{ media_url($heroProduct->image) }}" alt="{{ $heroProduct->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center text-sm text-gray-400">No image</div>
                            @endif
                            <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                                <span class="rounded-full bg-white/90 px-3 py-1 text-[11px] font-semibold text-gray-950 shadow-sm backdrop-blur">Ready stock</span>
                                @if ($heroProduct->is_on_sale)
                                    <span class="rounded-full bg-red-600 px-3 py-1 text-[11px] font-semibold text-white shadow-sm">Diskon aktif</span>
                                @endif
                            </div>
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent p-5 text-white">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-white/70">Stok siap checkout</p>
                                <h2 class="mt-1 line-clamp-2 text-xl font-semibold leading-tight">{{ \Illuminate\Support\Str::title($heroProduct->name) }}</h2>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    @if ($heroProduct->is_on_sale)
                                        <span class="text-xs text-white/60 line-through">{{ rupiah($heroProduct->price) }}</span>
                                    @endif
                                    <span class="text-sm font-semibold">{{ rupiah($heroProduct->final_price) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    @if ($supportProducts->isNotEmpty())
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            @foreach ($supportProducts as $product)
                                <a href="{{ route('landing.products.show', ['product' => $product, 'from' => 'home']) }}" class="group flex items-center gap-3 rounded-2xl border border-gray-100 bg-gray-50 p-2 transition hover:bg-gray-100">
                                    <div class="h-16 w-14 shrink-0 overflow-hidden rounded-xl bg-gray-100">
                                        @if ($product->image)
                                            <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                        @else
                                            <div class="flex h-full items-center justify-center text-[10px] text-gray-400">No image</div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="line-clamp-2 text-xs font-semibold text-gray-950">{{ \Illuminate\Support\Str::title($product->name) }}</p>
                                        @if ($product->is_on_sale)
                                            <p class="mt-1 text-[11px] font-semibold uppercase tracking-[0.12em] text-red-500">Diskon aktif</p>
                                        @else
                                            <p class="mt-1 text-[11px] font-semibold uppercase tracking-[0.12em] text-gray-400">Baru dicek</p>
                                        @endif
                                        <p class="mt-0.5 text-xs text-gray-500">{{ rupiah($product->final_price) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

<section class="mt-16 md:mt-20" aria-label="Etalase produk terbaru">
    @include('landing.sections.product-showcase', [
        'featuredProducts' => $featuredProducts,
        'hasMoreProducts' => $hasMoreProducts,
    ])
</section>




