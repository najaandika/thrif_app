<div class="mb-5 space-y-4">
    <div class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
        <div class="relative flex-1">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input
                wire:model.live="search"
                id="order_search"
                name="order_search"
                type="text"
                placeholder="Cari invoice, pembeli, kontak, atau produk"
                class="h-12 w-full rounded-2xl border border-slate-200 bg-white pl-12 pr-4 text-sm font-bold text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-200"
            >
        </div>

        <div class="inline-flex w-full rounded-2xl border border-slate-200 bg-slate-50 p-1 shadow-sm sm:w-auto" role="group" aria-label="Filter tipe order">
            @foreach(['all' => 'Semua', 'online' => 'Online', 'pos' => 'POS'] as $type => $label)
                <button
                    type="button"
                    wire:click="$set('orderType', '{{ $type }}')"
                    aria-pressed="{{ $orderType === $type ? 'true' : 'false' }}"
                    class="flex-1 rounded-xl px-4 py-2.5 text-xs font-extrabold transition focus:outline-none focus:ring-4 focus:ring-slate-200 sm:flex-none {{ $orderType === $type ? 'bg-slate-950 text-white shadow-sm' : 'text-slate-500 hover:bg-white hover:text-slate-950' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
        <div class="inline-flex overflow-x-auto rounded-2xl border border-slate-200 bg-slate-50 p-1 shadow-sm" role="group" aria-label="Filter status order">
            @foreach([
                'all' => ['label' => 'Semua', 'count' => $orderStats['all']],
                'pending' => ['label' => 'Pending', 'count' => $orderStats['pending']],
                'paid' => ['label' => 'Lunas', 'count' => $orderStats['paid']],
            ] as $value => $item)
                <button
                    type="button"
                    wire:click="$set('status', '{{ $value }}')"
                    aria-pressed="{{ $status === $value ? 'true' : 'false' }}"
                    class="inline-flex min-w-fit items-center gap-2 rounded-xl px-4 py-2.5 text-xs font-extrabold transition focus:outline-none focus:ring-4 focus:ring-slate-200 {{ $status === $value ? 'bg-slate-950 text-white shadow-sm' : 'text-slate-500 hover:bg-white hover:text-slate-950' }}"
                >
                    <span>{{ $item['label'] }}</span>
                    <span class="{{ $status === $value ? 'bg-white/15 text-white' : 'bg-white text-slate-500 ring-1 ring-slate-200' }} rounded-full px-2 py-0.5 text-[10px]">
                        {{ $item['count'] }}
                    </span>
                </button>
            @endforeach
        </div>

        <div class="flex flex-row gap-2">
            <form action="{{ route('orders.export.excel') }}" method="GET" class="inline-block">
                <input type="hidden" name="search" value="{{ $search }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="hidden" name="orderType" value="{{ $orderType }}">
                <button type="submit"
                        class="inline-flex h-11 items-center rounded-xl border border-slate-200 bg-white px-4 text-xs font-extrabold text-slate-700 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h5M4 4h16v6l-4 10H8L4 10V4z" />
                    </svg>
                    Excel
                </button>
            </form>
            <form action="{{ route('orders.export.pdf') }}" method="GET" target="_blank" class="inline-block">
                <input type="hidden" name="search" value="{{ $search }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="hidden" name="orderType" value="{{ $orderType }}">
                <button type="submit"
                        class="inline-flex h-11 items-center rounded-xl border border-slate-200 bg-white px-4 text-xs font-extrabold text-slate-700 shadow-sm transition hover:border-rose-200 hover:bg-rose-50 hover:text-rose-700">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h10a2 2 0 012 2v14l-5-3-5 3-5-3V5a2 2 0 012-2z" />
                    </svg>
                    PDF
                </button>
            </form>
        </div>
    </div>
</div>

