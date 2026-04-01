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

            <div class="w-40 h-40 flex-shrink-0 relative" wire:ignore>
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
                    <p class="total-value-amount">{{ rupiah($stats['total_value'], false) }}</p>
                </div>
            </div>
            <div class="total-value-footer">
                <p class="total-value-desc">Akumulasi nilai semua produk yang kamu listing.</p>
            </div>
        </div>
    </div>
</div>
