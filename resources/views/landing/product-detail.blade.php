<x-layouts.landing
    :title="$product->name . ' - Mr Crab Shop'"
    :metaDescription="Str::limit(strip_tags($product->description ?? ''), 160)"
    :ogImage="$product->image ? media_url($product->image) : null"
>
    @php
        $gallery = $product->gallery;
        $from = request('from', 'catalog');
        $backUrl = $from === 'home' ? route('landing.home') : route('landing.products.index');
        $backLabel = $from === 'home' ? 'Home' : 'Katalog';
        $conditionColor = $product->condition_color;
    @endphp

    <div class="bg-[#f7faf9]">
        <div class="mx-auto max-w-7xl px-4 pb-32 pt-6 sm:px-6 lg:px-8 lg:py-10">
            <nav class="mb-6 flex flex-wrap items-center gap-2 text-xs font-semibold text-slate-500" aria-label="Breadcrumb">
                <a href="{{ route('landing.home') }}" class="transition hover:text-slate-950">Home</a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('landing.products.index') }}" class="transition hover:text-slate-950">Katalog</a>
                <span class="text-slate-300">/</span>
                <span class="max-w-[220px] truncate text-slate-950">{{ $product->name }}</span>
            </nav>

            <div class="grid gap-6 lg:grid-cols-[minmax(0,1.05fr)_minmax(380px,0.95fr)] lg:items-start">
                <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_18px_60px_rgba(15,23,42,0.06)]">
                    <div class="relative aspect-square overflow-hidden bg-white sm:aspect-[5/4] lg:aspect-[4/4.2]">
                        @if ($gallery->isNotEmpty())
                            <div class="flex h-full w-full snap-x snap-mandatory overflow-x-auto scroll-smooth no-scrollbar" aria-label="Galeri foto {{ $product->name }}">
                                @foreach($gallery as $index => $img)
                                    <figure class="relative flex h-full w-full shrink-0 snap-center items-center justify-center bg-white">
                                        <img
                                            src="{{ media_url($img->image_path) }}"
                                            alt="{{ $product->name }} - Foto {{ $index + 1 }}"
                                            class="max-h-full max-w-full object-contain p-3 sm:p-4"
                                            @if($index > 0) loading="lazy" @endif
                                        >
                                    </figure>
                                @endforeach
                            </div>
                        @else
                            <div class="flex h-full w-full items-center justify-center text-sm font-semibold text-slate-500">
                                Foto produk menyusul
                            </div>
                        @endif
<div class="absolute left-3 top-3 flex flex-wrap gap-2 sm:left-4 sm:top-4">
                            <span class="inline-flex items-center rounded-full border border-white/80 bg-white/90 px-3 py-1.5 text-[11px] font-bold text-slate-950 shadow-sm backdrop-blur">
                                {{ $product->is_available ? 'Ready stock' : 'Sold out' }}
                            </span>
                            @if ($product->is_on_sale)
                                <span class="inline-flex items-center rounded-full bg-red-600 px-3 py-1.5 text-[11px] font-bold text-white shadow-sm">
                                    -{{ $product->discount_percent }}%
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($gallery->count() > 1)
                        <div class="flex gap-2 overflow-x-auto border-t border-slate-100 bg-white p-3 no-scrollbar" aria-label="Thumbnail foto produk">
                            @foreach($gallery as $index => $img)
                                <div class="h-16 w-16 shrink-0 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100 shadow-sm">
                                    <img src="{{ media_url($img->image_path) }}" alt="Thumbnail {{ $index + 1 }}" class="h-full w-full object-cover" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <aside class="lg:sticky lg:top-28">
                    <section class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_18px_60px_rgba(15,23,42,0.06)] sm:p-6 lg:p-7">
<div class="space-y-4">
                            <div>
                                <p class="text-[11px] font-extrabold uppercase tracking-[0.18em] text-slate-400">Detail produk</p>
                                <h1 class="mt-2 text-3xl font-black leading-tight tracking-[-0.04em] text-slate-950 sm:text-4xl">{{ Str::title($product->name) }}</h1>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-bold text-slate-600">
                                    {{ $product->category ?? 'Tanpa kategori' }}
                                </span>
                                <span class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-bold shadow-sm" style="border-color: {{ $conditionColor }}33; background-color: {{ $conditionColor }}12; color: {{ $conditionColor }};">
                                    {{ $product->condition_label }}
                                </span>
                                @if($product->size)
                                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-700">
                                        Size {{ $product->size }}
                                    </span>
                                @endif
                            </div>

                            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-4">
                                @if ($product->is_on_sale)
                                    <p class="text-sm font-semibold text-slate-400 line-through">{{ rupiah($product->price) }}</p>
                                    <div class="mt-1 flex flex-wrap items-end gap-2">
                                        <p class="text-3xl font-black tracking-[-0.03em] text-red-600">{{ rupiah($product->final_price) }}</p>
                                        <span class="mb-1 rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-600">Hemat {{ rupiah($product->price - $product->final_price) }}</span>
                                    </div>
                                @else
                                    <p class="text-3xl font-black tracking-[-0.03em] text-slate-950">{{ rupiah($product->price) }}</p>
                                @endif
                                <p class="mt-2 text-xs font-medium text-slate-500">Harga final sesuai item yang ditampilkan. Stok thrift terbatas satuan.</p>
                            </div>

                            <div class="grid grid-cols-3 overflow-hidden rounded-[1.35rem] border border-slate-200 bg-white divide-x divide-slate-100">
                                <div class="p-3">
                                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Kondisi</p>
                                    <p class="mt-1 text-sm font-black text-slate-950">Dicek manual</p>
                                </div>
                                <div class="p-3">
                                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Stok</p>
                                    <p class="mt-1 text-sm font-black text-slate-950">{{ $product->is_available ? 'Satuan' : 'Habis' }}</p>
                                </div>
                                <div class="p-3">
                                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Checkout</p>
                                    <p class="mt-1 text-sm font-black text-slate-950">Aman</p>
                                </div>
                            </div>

                            @if ($product->description)
                                <div class="border-t border-slate-100 pt-5">
                                    <h2 class="text-sm font-black text-slate-950">Catatan produk</h2>
                                    <p class="mt-2 whitespace-pre-line text-sm font-medium leading-7 text-slate-600">{{ strip_tags($product->description) }}</p>
                                </div>
                            @endif
                            <div class="grid gap-3 pt-1">
                                @auth
                                    <form action="{{ route('landing.products.action') }}" method="POST" class="grid gap-3">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" name="action" value="checkout" aria-label="Beli {{ $product->name }} sekarang" class="inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 text-sm font-black text-white shadow-xl shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                                            Beli Sekarang
                                            <span aria-hidden="true">&rarr;</span>
                                        </button>
                                        <button type="submit" name="action" value="cart" aria-label="Tambah {{ $product->name }} ke keranjang" class="inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 text-sm font-black text-slate-950 transition hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50">
                                            Tambah Keranjang
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" data-requires-login aria-label="Masuk untuk membeli {{ $product->name }}" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 text-sm font-black text-white shadow-xl shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                                        Beli Sekarang
                                        <span aria-hidden="true">&rarr;</span>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </section>
                </aside>
            </div>

            @if($relatedProducts->isNotEmpty())
                <section class="mt-12 pb-4">
                    <div class="mb-6 flex items-end justify-between gap-4">
                        <div>
                            <p class="text-[11px] font-extrabold uppercase tracking-[0.18em] text-slate-400">Produk serupa</p>
                            <h2 class="mt-2 text-2xl font-black tracking-[-0.03em] text-slate-950">Masih mirip gaya ini.</h2>
                        </div>
                        <a href="{{ route('landing.products.index') }}" class="hidden text-sm font-bold text-slate-500 transition hover:text-slate-950 sm:inline-flex">Buka katalog</a>
                    </div>

                    <div class="-mx-4 flex snap-x snap-mandatory gap-3 overflow-x-auto px-4 pb-4 no-scrollbar sm:mx-0 sm:grid sm:grid-cols-2 sm:px-0 lg:grid-cols-4">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('landing.products.show', $related) }}" class="group w-[68vw] max-w-[15rem] shrink-0 snap-start overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-xl hover:shadow-slate-950/8 sm:w-auto sm:max-w-none">
                                <div class="relative aspect-square overflow-hidden bg-slate-100">
                                    @if($related->image)
                                        <img src="{{ media_url($related->image) }}" alt="{{ $related->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-xs font-semibold text-slate-500">No Image</div>
                                    @endif
                                    @if($related->is_on_sale)
                                        <span class="absolute left-3 top-3 rounded-full bg-red-600 px-2.5 py-1 text-[10px] font-bold text-white shadow-md">-{{ $related->discount_percent }}%</span>
                                    @endif
                                </div>
                                <div class="p-3 sm:p-4">
                                    <p class="line-clamp-2 min-h-[2.4rem] text-sm font-extrabold leading-snug text-slate-950">{{ Str::title($related->name) }}</p>
                                    <div class="mt-3 flex items-end justify-between gap-2">
                                        <div>
                                            @if($related->is_on_sale)
                                                <p class="text-[11px] font-medium text-slate-400 line-through">{{ rupiah($related->price) }}</p>
                                                <p class="text-sm font-black text-red-600">{{ rupiah($related->final_price) }}</p>
                                            @else
                                                <p class="text-sm font-black text-slate-950">{{ rupiah($related->price) }}</p>
                                            @endif
                                        </div>
                                        <span class="rounded-full border px-2 py-0.5 text-[10px] font-bold" style="border-color: {{ $related->condition_color }}33; background-color: {{ $related->condition_color }}12; color: {{ $related->condition_color }};">{{ $related->condition_label }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif</div>
    </div>
</x-layouts.landing>


