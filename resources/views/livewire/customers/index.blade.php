<div class="dashboard-container">
    <div class="dashboard-content-wrapper">
        <div class="dashboard-content">
            <div class="dashboard-page-header">
                <div>
                    <p class="dashboard-eyebrow">Customer</p>
                    <h1 class="dashboard-page-title">Data pembeli.</h1>
                    <p class="dashboard-page-desc">Ringkasan akun customer yang pernah daftar dan bisa melakukan checkout online.</p>
                </div>
            </div>

            <div class="dashboard-kpi-grid mb-5">
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Customer</p>
                    <p class="dashboard-kpi-value mt-3">{{ $totalCustomers }}</p>
                </div>
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Order online</p>
                    <p class="dashboard-kpi-value mt-3">{{ $onlineOrders }}</p>
                </div>
            </div>

            <div class="card-base">
                <div class="card-header">
                    <h3 class="card-title">Customer terbaru</h3>
                    <p class="card-subtitle">Akun pembeli yang terakhir masuk ke sistem.</p>
                </div>

                <div class="list-container">
                    @forelse($customers as $customer)
                        <div class="product-item">
                            <div class="dashboard-order-icon">{{ strtoupper(substr($customer->name, 0, 1)) }}</div>
                            <div class="product-details">
                                <p class="product-name">{{ $customer->name }}</p>
                                <p class="product-price-sm">{{ $customer->email }}</p>
                            </div>
                            <span class="badge-available">Customer</span>
                        </div>
                    @empty
                        <div class="empty-state-container">
                            <p class="empty-state-title">Belum ada customer</p>
                            <p class="empty-state-desc">Customer baru akan tampil setelah register.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
