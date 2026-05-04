<section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-4">
    <p class="{{ $labelClass }}">Produk</p>

    <div class="space-y-4">
        {{-- Image Section --}}
        <div class="w-full">
            <div class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 w-full aspect-square mx-auto group relative shadow-sm">
                @php $gallery = $product->gallery; @endphp
                @if ($gallery->isNotEmpty())
                    <div class="flex overflow-x-auto snap-x snap-mandatory h-full w-full no-scrollbar">
                        @foreach($gallery as $img)
                            <img src="{{ media_url($img->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover flex-shrink-0 snap-center">
                        @endforeach
                    </div>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 via-slate-100 to-slate-300 dark:from-slate-800 dark:via-slate-700 dark:to-slate-900 flex items-center justify-center text-[10px] text-gray-500 dark:text-gray-300 text-center p-2">
                        Foto produk menyusul
                    </div>
                @endif
                @if ($product->is_on_sale)
                    <div class="absolute top-2 left-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg animate-pulse">
                        -{{ $product->discount_percent }}% OFF
                    </div>
                @endif
            </div>
        </div>

        {{-- Details Section --}}
        <div class="space-y-3">
            <div class="text-center">
                <h1 class="text-lg font-bold text-gray-900 dark:text-gray-100 leading-tight px-2">{{ $product->name }}</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">{{ $product->category ?? 'Tanpa kategori' }}</p>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg font-bold text-xs text-white shadow-sm {{ $product->condition_class }}">
                    {{ $product->condition_label }}
                </span>
                <span class="px-3 py-1 rounded-lg bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-sm font-bold shadow-md ring-1 ring-gray-900/10 dark:ring-gray-100/20">
                    Size {{ $product->size ?? '-' }}
                </span>
            </div>

            <div class="text-center pt-1">
                @if ($product->is_on_sale)
                    <p class="text-lg text-gray-400 line-through">{{ rupiah($product->price) }}</p>
                    <p class="text-3xl font-extrabold text-red-500 tracking-tight">{{ rupiah($product->final_price) }}</p>
                    <p class="text-xs text-red-500 font-medium">Hemat {{ rupiah($product->price - $product->final_price) }}!</p>
                @else
                    <p class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 tracking-tight">{{ rupiah($product->price) }}</p>
                @endif
            </div>

            @if ($product->description)
                <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 text-left">
                    <h3 class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2 border-b border-gray-200 dark:border-gray-700 pb-2">Deskripsi Produk</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ strip_tags($product->description) }}</p>
                </div>
            @endif
        </div>
    </div>
</section>

