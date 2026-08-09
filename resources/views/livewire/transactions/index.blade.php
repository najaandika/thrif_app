<div class="dashboard-container">
    <div class="dashboard-content-wrapper">
        <div class="dashboard-content">
            <div class="dashboard-page-header">
                <div>
                    <p class="dashboard-eyebrow">Pembayaran</p>
                    <h1 class="dashboard-page-title">Transaksi order.</h1>
                    <p class="dashboard-page-desc">Pantau status pembayaran dan nilai transaksi terbaru dari checkout online maupun POS.</p>
                </div>
            </div>

            <div class="dashboard-kpi-grid mb-5">
                <div class="dashboard-kpi-card dashboard-kpi-card-dark">
                    <p class="dashboard-kpi-label text-white/55">Total paid</p>
                    <p class="dashboard-kpi-money">{{ rupiah($paidTotal) }}</p>
                </div>
                <div class="dashboard-kpi-card">
                    <p class="dashboard-kpi-label">Belum lunas</p>
                    <p class="dashboard-kpi-value mt-3">{{ $pendingTotal }}</p>
                </div>
            </div>

            <div class="card-base">
                <div class="card-header">
                    <h3 class="card-title">Transaksi terbaru</h3>
                    <p class="card-subtitle">Daftar order terakhir beserta status pembayarannya.</p>
                </div>

                <div class="dashboard-order-list">
                    @forelse($orders as $order)
                        <a href="{{ route('orders.index') }}" class="dashboard-order-item">
                            <div class="dashboard-order-main">
                                <div class="dashboard-order-icon">{{ strtoupper(substr($order->buyer_name ?: 'O', 0, 1)) }}</div>
                                <div class="min-w-0">
                                    <p class="dashboard-order-title">{{ $order->invoice_number }}</p>
                                    <p class="dashboard-order-desc">{{ $order->buyer_name ?: 'Customer' }} · {{ $order->payment_method ?? 'Belum dipilih' }}</p>
                                </div>
                            </div>
                            <div class="dashboard-order-side">
                                <span class="dashboard-status-badge {{ $order->payment_status === 'paid' ? 'dashboard-status-paid' : 'dashboard-status-pending' }}">
                                    {{ ucfirst($order->payment_status ?? 'pending') }}
                                </span>
                                <p class="dashboard-order-total">{{ rupiah($order->total_price) }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="empty-state-container">
                            <p class="empty-state-title">Belum ada transaksi</p>
                            <p class="empty-state-desc">Transaksi akan muncul setelah ada checkout.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
