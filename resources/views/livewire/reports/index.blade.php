<div class="dashboard-container">
    <div class="dashboard-content-wrapper">
        <div class="dashboard-content">
            <div class="dashboard-page-header">
                <div>
                    <p class="dashboard-eyebrow">Laporan</p>
                    <h1 class="dashboard-page-title">Ringkasan performa.</h1>
                    <p class="dashboard-page-desc">Snapshot penjualan, order lunas, dan stok ready untuk evaluasi toko.</p>
                </div>
            </div>

            <div class="dashboard-kpi-grid">
                <div class="dashboard-kpi-card dashboard-kpi-card-dark">
                    <p class="dashboard-kpi-label text-white/55">Revenue hari ini</p>
                    <p class="dashboard-kpi-money">{{ rupiah($todayRevenue) }}</p>
                </div>
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Revenue bulan ini</p>
                    <p class="dashboard-kpi-money text-slate-950">{{ rupiah($monthRevenue) }}</p>
                </div>
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Order lunas</p>
                    <p class="dashboard-kpi-value mt-3">{{ $paidOrders }}</p>
                </div>
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Produk ready</p>
                    <p class="dashboard-kpi-value mt-3">{{ $readyProducts }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
