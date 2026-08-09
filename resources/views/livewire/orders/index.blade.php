<div class="dashboard-container" wire:poll.5s>
    <div class="dashboard-content-wrapper">
        @include('livewire.orders._flash')

        <div class="dashboard-content">
            <div class="dashboard-page-header">
                <div>
                    <p class="dashboard-eyebrow">Order management</p>
                    <h1 class="dashboard-page-title">Pesanan toko.</h1>
                    <p class="dashboard-page-desc">Cek order masuk, konfirmasi pembayaran, dan pantau transaksi online maupun POS.</p>
                </div>
                <div class="dashboard-header-meta">
                    <span class="dashboard-live-dot"></span>
                    <span>{{ $orderStats['pending'] }} perlu cek</span>
                </div>
            </div>

            <div class="dashboard-kpi-grid mb-5">
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Total order</p>
                    <p class="dashboard-kpi-value mt-3">{{ $orderStats['all'] }}</p>
                </div>
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Menunggu</p>
                    <div class="dashboard-kpi-value-row">
                        <p class="dashboard-kpi-value">{{ $orderStats['pending'] }}</p>
                        <span class="dashboard-kpi-badge dashboard-kpi-badge-amber">Perlu cek</span>
                    </div>
                </div>
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Lunas</p>
                    <div class="dashboard-kpi-value-row">
                        <p class="dashboard-kpi-value">{{ $orderStats['paid'] }}</p>
                        <span class="dashboard-kpi-badge dashboard-kpi-badge-emerald">Paid</span>
                    </div>
                </div>
                <div class="dashboard-kpi-card dashboard-kpi-card-dark">
                    <p class="dashboard-kpi-label text-white/55">Channel</p>
                    <p class="mt-3 text-sm font-bold text-white/70">Online {{ $orderStats['online'] }} / POS {{ $orderStats['pos'] }}</p>
                </div>
            </div>

            <div class="card-base">
                <div class="p-4 sm:p-5">
                    @include('livewire.orders._filters')
                    @include('livewire.orders._table')
                    <div class="mt-5">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.orders._modal')
</div>

