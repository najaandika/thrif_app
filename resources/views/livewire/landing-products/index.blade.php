<div class="landing-container">

    <div class="search-form">
        <a href="{{ route('landing.home') }}" class="back-btn" aria-label="Kembali">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <div class="search-wrapper">
            <input
                type="text"
                wire:model.debounce.400ms="search"
                placeholder="Cari produk..."
                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 text-left"
                aria-label="Cari produk"
                style="text-align:left;"
            >
        </div>
        <button type="button" class="ml-2 px-4 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold shadow-md shadow-slate-900/40 transition-all" aria-label="Cari">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    {{-- Category Filters --}}
    <div class="mt-5 sm:mt-6 flex flex-wrap gap-2">
        <button
            type="button"
            wire:click="$set('category', '')"
            class="px-3 py-1.5 rounded-full text-xs font-semibold border transition-all
                {{ $category === ''
                    ? 'bg-slate-800 dark:bg-slate-700 border-slate-600 text-white shadow-sm shadow-slate-900/40'
                    : 'bg-white dark:bg-slate-900 border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-200 hover:border-slate-500'}}">
            Semua
        </button>

        @foreach($categories as $slug => $name)
            <button
                type="button"
                wire:click="$set('category', '{{ $slug }}')"
                class="px-3 py-1.5 rounded-full text-xs font-semibold border transition-all
                    {{ $category === $slug
                        ? 'bg-slate-800 dark:bg-slate-700 border-slate-600 text-white shadow-sm shadow-slate-900/40'
                        : 'bg-white dark:bg-slate-900 border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-200 hover:border-slate-500'}}">
                {{ $name }}
            </button>
        @endforeach
    </div>
    @if($products->count())
        <div class="mt-5 sm:mt-6 product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <a href="{{ route('landing.products.checkout', $product) }}" class="block">
                        <div class="relative">
                            <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image' }}" alt="{{ $product->name }}" class="product-image">
                            @if($product->stock === 0)
                                <span class="badge-out-of-stock">Out of Stock</span>
                            @else
                                <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded text-[10px] font-bold text-white shadow-sm
                                    {{ $product->condition === 'new' ? 'bg-blue-500' : 
                                      ($product->condition === 'like-new' ? 'bg-indigo-500' : 
                                      ($product->condition === 'good' ? 'bg-emerald-500' : 
                                      ($product->condition === 'fair' ? 'bg-yellow-500' : 'bg-orange-500'))) }}">
                                    {{ $product->condition_label }}
                                </span>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="text-green-600 font-bold text-sm">{{ rupiah($product->price) }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="pagination-container">{{ $products->links() }}</div>
    @else
        <div class="empty-state">Tidak ada produk ditemukan untuk "{{ request('search') }}"</div>
    @endif
</div>

