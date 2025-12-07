<!-- Recent Products -->
<div class="card-base card-recent-products">
    <div class="card-header">
        <div class="card-header-content">
            <div>
                <h3 class="card-title">Produk Terbaru</h3>
                <p class="card-subtitle">Produk terakhir yang kamu tambahkan</p>
            </div>
            <a href="{{ route('products.index') }}" class="view-all-btn">
                Lihat semua
            </a>
        </div>
    </div>

    <div class="list-container">
        @forelse($recent_products as $product)
            <div class="product-item">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-image-sm" />
                @else
                    <div class="product-placeholder">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

                <div class="product-details">
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price-sm">{{ rupiah($product->price) }}</p>
                </div>

                <div>
                    @if($product->is_available)
                        <span class="badge-available">Tersedia</span>
                    @else
                        <span class="badge-sold">Terjual</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state-container">
                <div class="empty-state-icon-wrapper">
                    <svg class="h-8 w-8 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <p class="empty-state-title">Belum ada produk</p>
                <p class="empty-state-desc">Mulai dengan menambahkan produk pertama</p>
                <a href="{{ route('products.create') }}" class="add-first-product-btn">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah produk pertama
                </a>
            </div>
        @endforelse
    </div>
</div>
