<div class="dashboard-container">
    <div class="dashboard-content-wrapper">
        <div class="dashboard-content">
            <div class="dashboard-page-header">
                <div>
                    <p class="dashboard-eyebrow">Admin overview</p>
                    <h1 class="dashboard-page-title">Dashboard toko.</h1>
                    <p class="dashboard-page-desc">Pantau order masuk, stok ready, promo aktif, dan aktivitas toko dari satu tempat.</p>
                </div>
                <div class="dashboard-header-meta">
                    <span class="dashboard-live-dot"></span>
                    <span>Operasional aktif</span>
                </div>
            </div>

            <div class="dashboard-grid-gap">
                @include('livewire.dashboard.kpi')
                @include('livewire.dashboard.stats')
                @include('livewire.dashboard.sales-chart')

                <div class="bottom-grid">
                    @include('livewire.dashboard.recent-products')
                    @include('livewire.dashboard.quick-actions')
                </div>

                @include('livewire.dashboard.recent-orders')
            </div>
        </div>
    </div>
</div>

