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

        <div class="action-item weekly-sales-container">
            <div class="flex flex-col w-full gap-3">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-4">
                        <div class="weekly-sales-icon-wrapper">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="action-title">Penjualan {{ $salesRange === 'weekly' ? 'Mingguan' : ($salesRange === 'monthly' ? 'Bulanan' : 'Tahunan') }}</p>
                            <p class="action-desc">
                                Performa
                                @if($salesRange === 'weekly')
                                    7 hari
                                @elseif($salesRange === 'monthly')
                                    30 hari
                                @else
                                    12 bulan
                                @endif
                                terakhir
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <select
                            wire:model.live="salesRange"
                            id="sales_range"
                            name="sales_range"
                            aria-label="Pilih rentang waktu penjualan"
                            class="text-xs border border-gray-200 dark:border-gray-700 rounded-lg px-2 py-1 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-1 focus:ring-gray-400"
                        >
                            <option value="weekly">Mingguan</option>
                            <option value="monthly">Bulanan</option>
                            <option value="yearly">Tahunan</option>
                        </select>
                        <div class="text-right">
                            <p class="weekly-sales-amount text-lg font-semibold tracking-tight">{{ rupiah($chart_data->sum()) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Mini Bar Chart -->
                <div class="chart-bars-container mt-1">
                    @foreach($chart_data as $value)
                        <div class="chart-bar-wrapper">
                            <div style="height: {{ ($value / $chart_max) * 100 }}%" class="chart-bar-fill"></div>
                            <div class="chart-tooltip">
                                <div class="chart-tooltip-text">
                                    {{ rupiah($value) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

