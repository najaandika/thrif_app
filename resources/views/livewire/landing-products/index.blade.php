<div class="landing-container">

    <form action="{{ route('landing.products.index') }}" method="get" class="search-form">
        <a href="{{ route('landing.home') }}" class="back-btn" aria-label="Kembali">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <div class="search-wrapper">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 text-left" aria-label="Cari produk" style="text-align:left;">
        </div>
        <button type="submit" class="ml-2 px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition-all" aria-label="Cari">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>
    @if($products->count())
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <a href="{{ route('landing.products.checkout', $product) }}" class="block">
                        <div class="relative">
                            <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image' }}" alt="{{ $product->name }}" class="product-image">
                            @if($product->stock === 0)
                                <span class="badge-out-of-stock">Out of Stock</span>
                            @elseif($product->created_at && $product->created_at->gt(now()->subDays(7)))
                                <span class="badge-new">New</span>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
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

