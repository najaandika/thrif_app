<div class="dashboard-container">
    <div class="dashboard-layout">
        <x-sidebar />
        
        <div class="dashboard-content-wrapper">
            <div class="dashboard-content">
                <div class="dashboard-grid-gap">
                    <!-- Stats & Chart -->
                    <div class="stats-grid">
                        <!-- Donut chart card -->
                        <div class="card-base card-chart">
                            <div class="flex flex-col sm:flex-row items-center gap-6">
                                <div class="flex-1 w-full">
                                    <div class="chart-header">
                                        <div>
                                            <p class="chart-title-sm">Status Produk</p>
                                            <h3 class="chart-title-lg">Ringkasan</h3>
                                        </div>
                                    </div>

                                    <div class="chart-legend-grid">
                                        <div class="chart-legend-item">
                                            <div class="legend-icon-wrapper bg-emerald-100 dark:bg-emerald-900/30">
                                                <div class="legend-dot bg-emerald-500"></div>
                                            </div>
                                            <div>
                                                <p class="legend-text-sm">Tersedia</p>
                                                <p class="legend-text-lg">{{ $stats['available_products'] }}</p>
                                            </div>
                                        </div>
                                        <div class="chart-legend-item">
                                            <div class="legend-icon-wrapper bg-rose-100 dark:bg-rose-900/30">
                                                <div class="legend-dot bg-rose-500"></div>
                                            </div>
                                            <div>
                                                <p class="legend-text-sm">Terjual</p>
                                                <p class="legend-text-lg">{{ $stats['sold_products'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-40 h-40 flex-shrink-0 relative">
                                    <canvas id="statusChart"
                                            data-available="{{ $stats['available_products'] }}"
                                            data-sold="{{ $stats['sold_products'] }}"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Total value card -->
                        <div class="card-base card-total-value">
                            <div class="flex flex-col h-full justify-between">
                                <div>
                                    <p class="total-value-label">Total Nilai</p>
                                    <div class="total-value-amount-wrapper">
                                        <p class="total-value-currency">Rp</p>
                                        <p class="total-value-amount">{{ number_format($stats['total_value'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="total-value-footer">
                                    <p class="total-value-desc">Akumulasi nilai semua produk yang kamu listing.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom grid -->
                    <div class="bottom-grid">
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
                                            <p class="product-price-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
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

                        <!-- Quick Actions -->
                        <div class="card-base card-quick-actions">
                            <div class="card-header">
                                <h3 class="card-title">Aksi Cepat</h3>
                                <p class="card-subtitle">Aksi yang sering kamu pakai</p>
                            </div>

                            <div class="list-container">
                                <a href="{{ route('products.create') }}" class="action-item">
                                    <div class="action-details">
                                        <div class="action-icon-wrapper">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="action-title">Tambah produk baru</p>
                                            <p class="action-desc">Tambah barang baru untuk dijual</p>
                                        </div>
                                    </div>
                                    <span class="shortcut-badge">⌘N</span>
                                </a>

                                <a href="{{ route('products.index') }}" class="action-item">
                                    <div class="action-details">
                                        <div class="action-icon-wrapper">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="action-title">Kelola produk</p>
                                            <p class="action-desc">Lihat dan edit semua listing</p>
                                        </div>
                                    </div>
                                    <span class="shortcut-badge">⌘P</span>
                                </a>

                                <div class="weekly-sales-container">
                                    <div class="weekly-sales-header">
                                        <div class="flex items-center gap-3">
                                            <div class="weekly-sales-icon-wrapper">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="weekly-sales-title">Penjualan Mingguan</p>
                                                <p class="weekly-sales-subtitle">Performa 7 hari terakhir</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="weekly-sales-amount">Rp {{ number_format($chart_data->sum(), 0, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    <!-- Mini Bar Chart -->
                                    <div class="chart-bars-container">
                                        @php $max = $chart_data->max() ?: 1; @endphp
                                        @foreach($chart_data as $value)
                                            <div class="chart-bar-wrapper">
                                                <div style="height: {{ ($value / $max) * 100 }}%" class="chart-bar-fill"></div>
                                                <!-- Tooltip -->
                                                <div class="chart-tooltip">
                                                    <div class="chart-tooltip-text">
                                                        Rp {{ number_format($value, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
