<div class="card-base dashboard-orders-card">
    <div class="card-header">
        <div class="card-header-content">
            <div>
                <h3 class="card-title">Order terbaru</h3>
                <p class="card-subtitle">Aktivitas checkout terakhir dari customer dan POS.</p>
            </div>
            <a href="{{ route('orders.index') }}" class="view-all-btn">Kelola order</a>
        </div>
    </div>

    <div class="dashboard-order-list">
        @forelse($recent_orders as $order)
            <a href="{{ route('orders.index') }}" class="dashboard-order-item">
                <div class="dashboard-order-main">
                    <div class="dashboard-order-icon">
                        {{ strtoupper(substr($order->buyer_name ?: 'O', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="dashboard-order-title">{{ $order->buyer_name ?: 'Customer' }}</p>
                        <p class="dashboard-order-desc">
                            {{ $order->invoice_number }} · {{ $order->created_at?->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <div class="dashboard-order-side">
                    <span class="dashboard-status-badge {{ $order->status === 'pending' ? 'dashboard-status-pending' : 'dashboard-status-paid' }}">
                        {{ $order->status_label ?? ucfirst($order->status) }}
                    </span>
                    <p class="dashboard-order-total">{{ rupiah($order->total_price) }}</p>
                </div>
            </a>
        @empty
            <div class="empty-state-container">
                <div class="empty-state-icon-wrapper">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h10a2 2 0 012 2v16l-3-2-2 2-2-2-2 2-3 2V5a2 2 0 012-2Z" />
                    </svg>
                </div>
                <p class="empty-state-title">Belum ada order</p>
                <p class="empty-state-desc">Order baru akan tampil di sini.</p>
            </div>
        @endforelse
    </div>
</div>
