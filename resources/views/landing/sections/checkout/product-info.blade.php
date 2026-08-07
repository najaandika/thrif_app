<section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_18px_60px_rgba(15,23,42,0.06)] lg:sticky lg:top-24">
    <div class="p-5 sm:p-6">
        <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Item dipilih</p>
        <h2 class="mt-2 text-2xl font-extrabold tracking-[-0.03em] text-slate-950">{{ Str::title($product->name) }}</h2>
        <div class="mt-4 flex flex-wrap gap-2">
            <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">{{ $product->category ?? 'Tanpa kategori' }}</span>
            <span class="rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">{{ $product->condition_label }}</span>
            <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">Size {{ $product->size ?? '-' }}</span>
        </div>
    </div>

    <div class="relative border-y border-slate-100 bg-slate-50">
        <div class="aspect-[4/5] w-full overflow-hidden bg-slate-100 sm:aspect-[5/4] lg:aspect-square">
            @php $gallery = $product->gallery; @endphp
            @if ($gallery->isNotEmpty())
                <div class="flex h-full w-full snap-x snap-mandatory overflow-x-auto no-scrollbar">
                    @foreach($gallery as $img)
                        <img src="{{ media_url($img->image_path) }}"
                             alt="{{ $product->name }}"
                             class="h-full w-full flex-shrink-0 snap-center object-contain p-3">
                    @endforeach
                </div>
            @else
                <div class="flex h-full w-full items-center justify-center p-6 text-center text-xs font-bold text-slate-400">Foto produk menyusul</div>
            @endif
        </div>

        @if ($product->is_on_sale)
            <span class="absolute left-4 top-4 rounded-full bg-red-600 px-3 py-1 text-xs font-bold text-white shadow-sm">-{{ $product->discount_percent }}%</span>
        @endif
    </div>

    <div class="space-y-4 p-5 sm:p-6">
        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-4">
            @if ($product->is_on_sale)
                <p class="text-sm font-semibold text-slate-400 line-through">{{ rupiah($product->price) }}</p>
                <div class="mt-1 flex flex-wrap items-center gap-2">
                    <p class="text-3xl font-extrabold tracking-[-0.04em] text-red-600">{{ rupiah($product->final_price) }}</p>
                    <span class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-600">Hemat {{ rupiah($product->price - $product->final_price) }}</span>
                </div>
            @else
                <p class="text-3xl font-extrabold tracking-[-0.04em] text-slate-950">{{ rupiah($product->price) }}</p>
            @endif
            <p class="mt-2 text-xs font-medium leading-5 text-slate-500">Harga final sesuai item yang ditampilkan. Stok thrift terbatas satuan.</p>
        </div>

        @if ($product->description)
            <div class="border-t border-slate-100 pt-4">
                <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Catatan produk</p>
                <p class="mt-2 text-sm font-medium leading-7 text-slate-600">{{ strip_tags($product->description) }}</p>
            </div>
        @endif
    </div>
</section>
