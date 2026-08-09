<div class="dashboard-container">
    <div class="dashboard-content-wrapper">
        <div class="dashboard-content">
            <div class="dashboard-page-header">
                <div>
                    <p class="dashboard-eyebrow">Promo</p>
                    <h1 class="dashboard-page-title">Flash sale & diskon.</h1>
                    <p class="dashboard-page-desc">Pantau produk yang sedang punya potongan harga dan siap ditampilkan di etalase sale.</p>
                </div>
                <div class="dashboard-header-meta">
                    <span class="dashboard-live-dot"></span>
                    <span>{{ $activePromos }} aktif</span>
                </div>
            </div>

            <div class="card-base">
                <div class="card-header">
                    <div class="card-header-content">
                        <div>
                            <h3 class="card-title">Produk promo</h3>
                            <p class="card-subtitle">Produk dengan diskon yang pernah atau sedang aktif.</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="view-all-btn">Kelola produk</a>
                    </div>
                </div>

                <div class="list-container">
                    @forelse($products as $product)
                        <a href="{{ route('products.edit', $product) }}" class="product-item">
                            @if($product->image)
                                <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" class="product-image-sm" />
                            @else
                                <div class="product-placeholder"></div>
                            @endif
                            <div class="product-details">
                                <p class="product-name">{{ $product->name }}</p>
                                <p class="product-price-sm">{{ rupiah($product->final_price) }} dari {{ rupiah($product->price) }}</p>
                            </div>
                            <span class="dashboard-kpi-badge dashboard-kpi-badge-rose">-{{ $product->discount_percent }}%</span>
                        </a>
                    @empty
                        <div class="empty-state-container">
                            <p class="empty-state-title">Belum ada promo</p>
                            <p class="empty-state-desc">Tambahkan diskon dari halaman edit produk.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
