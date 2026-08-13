<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-3xl">
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Pembayaran</p>
                <h1 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950 sm:text-4xl">Transaksi order.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Pantau status pembayaran checkout online dan POS agar order yang belum lunas cepat ditindaklanjuti.
                </p>
            </div>
            <a href="{{ route('orders.index') }}" class="inline-flex min-h-[3.25rem] w-fit items-center justify-center rounded-2xl bg-slate-950 px-5 text-sm font-black text-white shadow-[0_18px_45px_rgba(15,23,42,0.18)] transition hover:-translate-y-0.5 hover:bg-slate-800">
                Buka pesanan
            </a>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-[1.5rem] border border-slate-950 bg-slate-950 p-5 text-white shadow-[0_24px_80px_rgba(15,23,42,0.2)] xl:col-span-2">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-white/45">Total paid</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.04em]">{{ rupiah($paidTotal) }}</p>
                <p class="mt-3 text-sm font-semibold text-white/60">Akumulasi transaksi yang sudah lunas.</p>
            </div>
            <div class="rounded-[1.5rem] border border-amber-200 bg-amber-50 p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-amber-700">Belum lunas</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.04em] text-slate-950">{{ $pendingTotal }}</p>
                <p class="mt-2 text-sm font-semibold text-amber-800/70">Perlu cek pembayaran</p>
            </div>
            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Transaksi tampil</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.04em] text-slate-950">{{ $orders->count() }}</p>
                <p class="mt-2 text-sm font-semibold text-slate-500">Order terbaru</p>
            </div>
        </section>

        <section class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
            <div class="flex flex-col gap-3 border-b border-slate-200 p-5 sm:flex-row sm:items-end sm:justify-between sm:p-6">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Daftar transaksi</p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Transaksi terbaru.</h2>
                </div>
                <span class="inline-flex w-fit items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-extrabold uppercase tracking-[0.14em] text-slate-500">
                    {{ $orders->count() }} hasil
                </span>
            </div>

            <div class="divide-y divide-slate-200">
                @forelse($orders as $order)
                    @php
                        $paid = $order->payment_status === 'paid';
                    @endphp
                    <a href="{{ route('orders.index') }}" class="flex flex-col gap-4 p-5 transition hover:bg-slate-50/70 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                        <div class="flex min-w-0 items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl {{ $paid ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200' : 'bg-amber-50 text-amber-700 ring-1 ring-amber-200' }}">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h3 class="truncate text-base font-black text-slate-950">{{ $order->invoice_number }}</h3>
                                <p class="mt-1 truncate text-sm font-semibold text-slate-500">
                                    {{ $order->buyer_name ?: 'Customer' }} - {{ $order->payment_method ?? 'Belum dipilih' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-4 sm:justify-end">
                            <span class="inline-flex items-center whitespace-nowrap rounded-full border px-3 py-1.5 text-xs font-extrabold leading-none {{ $paid ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-amber-200 bg-amber-50 text-amber-700' }}">
                                {{ $paid ? 'Paid' : ucfirst($order->payment_status ?? 'Pending') }}
                            </span>
                            <p class="text-right text-base font-black text-slate-950">{{ rupiah($order->total_price) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="px-5 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 ring-1 ring-slate-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                        </div>
                        <p class="mt-5 text-xl font-black tracking-[-0.03em] text-slate-950">Belum ada transaksi.</p>
                        <p class="mt-2 text-sm font-semibold text-slate-500">Transaksi akan muncul setelah ada checkout atau POS.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
