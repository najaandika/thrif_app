<div class="card-base dashboard-sales-chart-card">
    <div class="card-header">
        <div class="card-header-content">
            <div>
                <h3 class="card-title">Grafik revenue</h3>
                <p class="card-subtitle">
                    Tren penjualan {{ $salesRange === 'weekly' ? '7 hari' : ($salesRange === 'monthly' ? '30 hari' : '12 bulan') }} terakhir.
                </p>
            </div>
            <div
                role="group"
                aria-label="Pilih rentang grafik revenue"
                class="inline-flex rounded-2xl border border-slate-200 bg-slate-50 p-1 shadow-sm"
            >
                @foreach([
                    'weekly' => '7 hari',
                    'monthly' => '30 hari',
                    'yearly' => '12 bulan',
                ] as $range => $label)
                    <button
                        type="button"
                        wire:click="$set('salesRange', '{{ $range }}')"
                        wire:loading.attr="disabled"
                        wire:target="salesRange"
                        aria-pressed="{{ $salesRange === $range ? 'true' : 'false' }}"
                        class="rounded-xl px-3 py-2 text-xs font-extrabold transition focus:outline-none focus:ring-4 focus:ring-slate-200 {{ $salesRange === $range ? 'bg-slate-950 text-white shadow-sm' : 'text-slate-500 hover:bg-white hover:text-slate-950' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="dashboard-sales-chart-body">
        <div class="dashboard-sales-total">
            <p class="dashboard-kpi-label">Total periode</p>
            <p class="dashboard-sales-total-value">{{ rupiah($chart_data->sum()) }}</p>
        </div>

        <div class="dashboard-sales-bars">
            @foreach($chart_data as $index => $value)
                <div class="dashboard-sales-bar-cell">
                    <div class="dashboard-sales-bar-track">
                        <div
                            class="dashboard-sales-bar-fill"
                            style="height: {{ max(6, ($value / $chart_max) * 100) }}%"
                            title="{{ rupiah($value) }}"
                        ></div>
                    </div>
                    <span class="dashboard-sales-bar-label">{{ $index + 1 }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
