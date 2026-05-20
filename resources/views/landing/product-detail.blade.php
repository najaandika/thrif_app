<x-layouts.landing 
    :title="$product->name . ' - Mr Crab Shop'"
    :metaDescription="Str::limit(strip_tags($product->description ?? ''), 160)"
    :ogImage="$product->image ? media_url($product->image) : null"
>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Breadcrumb --}}
        <nav class="mb-6 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <ol class="flex items-center gap-2">
                <li><a href="{{ route('landing.home') }}" class="hover:text-gray-900 dark:hover:text-gray-100">Home</a></li>
                <li><span>/</span></li>
                <li><a href="{{ route('landing.products.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100">Produk</a></li>
                <li><span>/</span></li>
                <li class="text-gray-900 dark:text-gray-100 font-medium truncate max-w-[200px]">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="grid gap-8 lg:grid-cols-2">
            {{-- Product Images --}}
            <div class="space-y-4">
                <div class="rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 aspect-square relative group shadow-sm bg-white dark:bg-gray-900">
                    @php $gallery = $product->gallery; @endphp
                    @if ($gallery->isNotEmpty())
                        <div class="flex overflow-x-auto snap-x snap-mandatory h-full w-full no-scrollbar" id="product-gallery">
                            @foreach($gallery as $index => $img)
                                <img src="{{ media_url($img->image_path) }}" 
                                     alt="{{ $product->name }} - Foto {{ $index + 1 }}" 
                                     class="w-full h-full object-cover flex-shrink-0 snap-center">
                            @endforeach
                        </div>
                        @if($gallery->count() > 1)
                            <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
                                @foreach($gallery as $index => $img)
                                    <span class="w-2 h-2 rounded-full bg-white/70 shadow"></span>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-slate-200 via-slate-100 to-slate-300 dark:from-slate-800 dark:via-slate-700 dark:to-slate-900 flex items-center justify-center text-sm text-gray-500 dark:text-gray-300">
                            Foto produk menyusul
                        </div>
                    @endif
                    @if ($product->is_on_sale)
                        <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            -{{ $product->discount_percent }}% OFF
                        </div>
                    @endif
                </div>

                {{-- Thumbnail strip --}}
                @if($gallery->count() > 1)
                    <div class="flex gap-2 overflow-x-auto no-scrollbar">
                        @foreach($gallery as $index => $img)
                            <div class="w-16 h-16 rounded-lg overflow-hidden border-2 border-gray-200 dark:border-gray-700 flex-shrink-0 cursor-pointer hover:border-slate-900 dark:hover:border-slate-400 transition">
                                <img src="{{ media_url($img->image_path) }}" alt="" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="space-y-6">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase mb-1">{{ $product->category ?? 'Tanpa kategori' }}</p>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 leading-tight">{{ $product->name }}</h1>
                </div>

                {{-- Price --}}
                <div>
                    @if ($product->is_on_sale)
                        <p class="text-lg text-gray-400 line-through">{{ rupiah($product->price) }}</p>
                        <p class="text-3xl font-extrabold text-red-500 tracking-tight">{{ rupiah($product->final_price) }}</p>
                        <p class="text-sm text-red-500 font-medium mt-1">Hemat {{ rupiah($product->price - $product->final_price) }}!</p>
                    @else
                        <p class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 tracking-tight">{{ rupiah($product->price) }}</p>
                    @endif
                </div>

                {{-- Badges --}}
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg font-bold text-xs text-white shadow-sm {{ $product->condition_class }}">
                        {{ $product->condition_label }}
                    </span>
                    @if($product->size)
                        <span class="px-3 py-1.5 rounded-lg bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-sm font-bold shadow-md">
                            Size {{ $product->size }}
                        </span>
                    @endif
                </div>

                {{-- Description --}}
                @if ($product->description)
                    <div class="p-5 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-3">Deskripsi Produk</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ strip_tags($product->description) }}</p>
                    </div>
                @endif

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    @auth
                        <a href="{{ route('landing.products.checkout', $product) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-2 rounded-2xl bg-gray-900 dark:bg-gray-100 px-6 py-3.5 text-sm font-semibold text-white dark:text-gray-900 shadow-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Beli Sekarang
                        </a>
                        <form action="{{ route('landing.cart.store') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-2xl border-2 border-gray-900 dark:border-gray-100 px-6 py-3.5 text-sm font-semibold text-gray-900 dark:text-gray-100 transition-all duration-300 hover:bg-gray-900 hover:text-white dark:hover:bg-gray-100 dark:hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" data-requires-login
                           class="flex-1 inline-flex items-center justify-center gap-2 rounded-2xl bg-gray-900 dark:bg-gray-100 px-6 py-3.5 text-sm font-semibold text-white dark:text-gray-900 shadow-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Beli Sekarang
                        </a>
                        <a href="{{ route('login') }}" data-requires-login
                           class="flex-1 inline-flex items-center justify-center gap-2 rounded-2xl border-2 border-gray-900 dark:border-gray-100 px-6 py-3.5 text-sm font-semibold text-gray-900 dark:text-gray-100 transition-all duration-300 hover:bg-gray-900 hover:text-white dark:hover:bg-gray-100 dark:hover:text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Tambah ke Keranjang
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Produk Serupa</h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('landing.products.show', $related) }}" class="group block">
                            <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 aspect-square bg-white dark:bg-gray-900">
                                <img src="{{ $related->image ? media_url($related->image) : 'https://via.placeholder.com/200x200?text=No+Image' }}" 
                                     alt="{{ $related->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="mt-2">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $related->name }}</p>
                                @if($related->is_on_sale)
                                    <p class="text-sm font-bold text-red-500">{{ rupiah($related->final_price) }}</p>
                                @else
                                    <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">{{ rupiah($related->price) }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.landing>
