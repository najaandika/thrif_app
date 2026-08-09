@php
    $totalProducts = max(1, ($stats['available_products'] ?? 0) + ($stats['sold_products'] ?? 0));
    $availablePercent = min(100, round((($stats['available_products'] ?? 0) / $totalProducts) * 100));
    $soldPercent = min(100, round((($stats['sold_products'] ?? 0) / $totalProducts) * 100));
@endphp

<!-- Product health + value -->
<div class="stats-grid">
    <div class="card-base card-chart">
        <div class="chart-header">
            <div>
                <p class="chart-title-sm">Kesehatan etalase</p>
                <h3 class="chart-title-lg">Stok ready masih dominan.</h3>
            </div>
            <span class="dashboard-kpi-badge dashboard-kpi-badge-emerald">{{ $availablePercent }}% ready</span>
        </div>

        <div class="space-y-5">
            <div>
                <div class="mb-2 flex items-center justify-between gap-3">
                    <p class="text-sm font-extrabold text-slate-700">Produk tersedia</p>
                    <p class="text-sm font-extrabold text-slate-950">{{ $stats['available_products'] }} item</p>
                </div>
                <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                    <div class="h-full rounded-full bg-emerald-500" style="width: {{ $availablePercent }}%"></div>
                </div>
            </div>

            <div class="chart-legend-grid">
                <div class="chart-legend-item">
                    <div class="legend-icon-wrapper bg-emerald-100">
                        <div class="legend-dot bg-emerald-500"></div>
                    </div>
                    <div>
                        <p class="legend-text-sm">Ready dijual</p>
                        <p class="legend-text-lg">{{ $stats['available_products'] }}</p>
                    </div>
                </div>
                <div class="chart-legend-item">
                    <div class="legend-icon-wrapper bg-rose-100">
                        <div class="legend-dot bg-rose-500"></div>
                    </div>
                    <div>
                        <p class="legend-text-sm">Sudah terjual</p>
                        <p class="legend-text-lg">{{ $stats['sold_products'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Terjual</p>
                        <p class="mt-1 text-sm font-bold text-slate-600">{{ $soldPercent }}% dari total listing</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="dashboard-secondary-link min-h-9 px-3 text-xs">Kelola stok</a>
                </div>
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

