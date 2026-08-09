<div class="dashboard-kpi-grid">
    <div class="dashboard-kpi-card">
        <p class="dashboard-kpi-label">Order pending</p>
        <div class="dashboard-kpi-value-row">
            <p class="dashboard-kpi-value">{{ $stats['pending_orders'] }}</p>
            <span class="dashboard-kpi-badge dashboard-kpi-badge-amber">Perlu cek</span>
        </div>
    </div>

    <div class="dashboard-kpi-card">
        <p class="dashboard-kpi-label">Order selesai</p>
        <div class="dashboard-kpi-value-row">
            <p class="dashboard-kpi-value">{{ $stats['paid_orders'] }}</p>
            <span class="dashboard-kpi-badge dashboard-kpi-badge-emerald">Paid</span>
        </div>
    </div>

    <div class="dashboard-kpi-card">
        <p class="dashboard-kpi-label">Produk promo</p>
        <div class="dashboard-kpi-value-row">
            <p class="dashboard-kpi-value">{{ $stats['discount_products'] }}</p>
            <span class="dashboard-kpi-badge dashboard-kpi-badge-rose">Sale</span>
        </div>
    </div>

    <div class="dashboard-kpi-card dashboard-kpi-card-dark">
        <p class="dashboard-kpi-label text-white/55">Revenue lunas</p>
        <p class="dashboard-kpi-money">{{ rupiah($stats['paid_revenue']) }}</p>
    </div>
</div>
