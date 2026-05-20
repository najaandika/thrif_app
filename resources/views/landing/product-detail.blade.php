<x-layouts.landing 
    :title="$product->name . ' - Mr Crab Shop'"
    :metaDescription="Str::limit(strip_tags($product->description ?? ''), 160)"
    :ogImage="$product->image ? media_url($product->image) : null"
>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Breadcrumb --}}
        <nav class="mb-6 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <ol class="flex items-center gap-2 flex-wrap">
                <li><a href="{{ route('landing.home') }}" class="hover:text-gray-900 dark:hover:text-gray-100">Home</a></li>
                <li class="text-gray-300 dark:text-gray-700">/</li>
                <li><a href="{{ route('landing.products.index') }}" class="hover:text-gray-900 dark:hover:text-gray-100">Produk</a></li>
                <li class="text-gray-300 dark:text-gray-700">/</li>
                <li class="text-gray-900 dark:text-gray-100 font-medium truncate max-w-[200px]">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="grid gap-6 lg:grid-cols-2">
            {{-- Product Images --}}
            <section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-4">
                <div class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 aspect-square relative shadow-sm">
                    @php $gallery = $product->gallery; @endphp
                    @if ($gallery->isNotEmpty())
                        <div class="flex overflow-x-auto snap-x snap-mandatory h-full w-full no-scrollbar">
                            @foreach($gallery as $index => $img)
                                <img src="{{ media_url($img->image_path) }}" 
                                     alt="{{ $product->name }} - Foto {{ $index + 1 }}" 
                                     class="w-full h-full object-cover flex-shrink-0 snap-center">
                            @endforeach
                        </div>
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
                    <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1">
                        @foreach($gallery as $index => $img)
                            <div class="w-16 h-16 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 flex-shrink-0">
                                <img src="{{ media_url($img->image_path) }}" alt="" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            {{-- Product Info --}}
            <section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-5">
                <p class="text-[11px] font-semibold tracking-[0.2em] text-gray-500 dark:text-gray-400 uppercase">Produk</p>

                <div class="space-y-2">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 leading-tight">{{ $product->name }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Kategori: {{ $product->category ?? 'Tanpa kategori' }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Kondisi: 
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md font-semibold text-xs text-white shadow-sm {{ $product->condition_class }}" style="background-color: {{ $product->condition_color }};">
                            {{ $product->condition_label }}
                        </span>
                    </p>
                    @if($product->size)
                        <p class="text-sm text-gray-500 dark:text-gray-400">Ukuran: <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $product->size }}</span></p>
                    @endif
                </div>

                {{-- Price --}}
                <div class="pt-2 border-t border-gray-100 dark:border-gray-800">
                    @if ($product->is_on_sale)
                        <p class="text-lg text-gray-400 line-through">{{ rupiah($product->price) }}</p>
                        <p class="text-3xl font-bold text-red-500">{{ rupiah($product->final_price) }}</p>
                        <p class="text-xs text-red-500 font-medium mt-1">Hemat {{ rupiah($product->price - $product->final_price) }}!</p>
                    @else
                        <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ rupiah($product->price) }}</p>
                    @endif
                </div>

                {{-- Description --}}
                @if ($product->description)
                    <div class="pt-2 border-t border-gray-100 dark:border-gray-800">
                        <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Deskripsi:</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed whitespace-pre-line">{{ strip_tags($product->description) }}</p>
                    </div>
                @endif

                {{-- Status Box --}}
                <div class="rounded-2xl bg-gray-50 dark:bg-gray-800/70 p-4 text-xs text-gray-600 dark:text-gray-300 space-y-1">
                    <p>Status: <span class="font-semibold {{ $product->is_available ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500' }}">{{ $product->is_available ? 'Ready to ship' : 'Sold Out' }}</span></p>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    @auth
                        <a href="{{ route('landing.products.checkout', $product) }}" 
                           aria-label="Beli {{ $product->name }} sekarang"
                           class="flex-[2] inline-flex items-center justify-center gap-2 rounded-full px-6 py-3 text-sm font-semibold shadow-md transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2"
                           style="background-color: #047857; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Beli Sekarang
                        </a>
                        <form action="{{ route('landing.cart.store') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" 
                                    aria-label="Tambah {{ $product->name }} ke keranjang"
                                    class="w-full inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold shadow-md transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2"
                                    style="background-color: #0f172a; color: #ffffff;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Keranjang
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" data-requires-login
                           aria-label="Login untuk membeli {{ $product->name }}"
                           class="flex-[2] inline-flex items-center justify-center gap-2 rounded-full px-6 py-3 text-sm font-semibold shadow-md transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2"
                           style="background-color: #047857; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Beli Sekarang
                        </a>
                        <a href="{{ route('login') }}" data-requires-login
                           aria-label="Login untuk menambah ke keranjang"
                           class="flex-1 inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold shadow-md transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2"
                           style="background-color: #0f172a; color: #ffffff;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Keranjang
                        </a>
                    @endauth
                </div>
            </section>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
            <section class="mt-12">
                <div class="flex items-center gap-2 mb-5">
                    <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                    <h2 class="text-sm font-semibold tracking-wide text-gray-700 dark:text-gray-200 uppercase">Produk Serupa</h2>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('landing.products.show', $related) }}" class="group block rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-emerald-500/10 hover:-translate-y-0.5">
                            <div class="aspect-square overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 relative">
                                @if($related->image)
                                    <img src="{{ media_url($related->image) }}" 
                                         alt="{{ $related->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">No Image</div>
                                @endif
                                @if($related->is_on_sale)
                                    <span class="absolute top-2 right-2 px-2 py-0.5 rounded-full text-[10px] font-bold text-white bg-gradient-to-r from-red-500 to-orange-500 shadow-md">
                                        -{{ $related->discount_percent }}%
                                    </span>
                                @endif
                            </div>
                            <div class="p-3">
                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $related->name }}</p>
                                @if($related->is_on_sale)
                                    <div class="flex items-baseline gap-1.5 mt-1">
                                        <span class="text-xs text-gray-400 line-through">{{ rupiah($related->price) }}</span>
                                        <span class="text-sm font-bold text-red-500">{{ rupiah($related->final_price) }}</span>
                                    </div>
                                @else
                                    <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ rupiah($related->price) }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.landing>
