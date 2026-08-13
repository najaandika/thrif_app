@php
    $totalRevenue = max(1, $monthRevenue);
    $todayPercent = min(100, round(($todayRevenue / $totalRevenue) * 100));
    $paidPercent = min(100, $paidOrders > 0 ? 100 : 0);
@endphp

<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-3xl">
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Laporan toko</p>
                <h1 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950 sm:text-4xl">Ringkasan performa.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Pantau revenue, order lunas, dan stok ready untuk membaca kondisi toko hari ini.
                </p>
            </div>
            <span class="inline-flex w-fit items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-black text-slate-700 shadow-sm">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                Update realtime
            </span>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-[1.5rem] border border-slate-950 bg-slate-950 p-5 text-white shadow-[0_24px_80px_rgba(15,23,42,0.2)] xl:col-span-2">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-white/45">Revenue bulan ini</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.04em]">{{ rupiah($monthRevenue) }}</p>
                <div class="mt-6 h-2 overflow-hidden rounded-full bg-white/10">
                    <div class="h-full rounded-full bg-white" style="width: {{ max(8, $todayPercent) }}%"></div>
                </div>
                <p class="mt-3 text-sm font-semibold text-white/60">Hari ini menyumbang {{ $todayPercent }}% dari revenue bulan ini.</p>
            </div>
            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Revenue hari ini</p>
                <p class="mt-4 text-3xl font-black tracking-[-0.04em] text-slate-950">{{ rupiah($todayRevenue) }}</p>
                <p class="mt-2 text-sm font-semibold text-slate-500">Transaksi lunas hari ini</p>
            </div>
            <div class="rounded-[1.5rem] border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-emerald-700">Order lunas</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.04em] text-slate-950">{{ $paidOrders }}</p>
                <p class="mt-2 text-sm font-semibold text-emerald-800/70">Paid, shipped, completed</p>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_24rem]">
            <div class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                <div class="border-b border-slate-200 p-5 sm:p-6">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Breakdown</p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Kesehatan toko.</h2>
                </div>
                <div class="grid gap-4 p-5 sm:p-6 md:grid-cols-3">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-5">
                        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Produk ready</p>
                        <p class="mt-4 text-4xl font-black text-slate-950">{{ $readyProducts }}</p>
                        <p class="mt-2 text-sm font-semibold text-slate-500">Item bisa dijual</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-5">
                        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Paid ratio</p>
                        <p class="mt-4 text-4xl font-black text-slate-950">{{ $paidPercent }}%</p>
                        <p class="mt-2 text-sm font-semibold text-slate-500">Order lunas tercatat</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-5">
                        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Bulan aktif</p>
                        <p class="mt-4 text-4xl font-black text-slate-950">{{ now()->format('M') }}</p>
                        <p class="mt-2 text-sm font-semibold text-slate-500">{{ now()->format('Y') }}</p>
                    </div>
                </div>
            </div>

            <aside class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Catatan</p>
                <h3 class="mt-3 text-xl font-black tracking-[-0.035em] text-slate-950">Yang perlu dipantau.</h3>
                <div class="mt-5 space-y-3 text-sm font-bold text-slate-600">
                    <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>Produk ready tetap cukup</div>
                    <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-amber-400"></span>Order pending perlu follow-up</div>
                    <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-rose-500"></span>Produk promo jangan terlalu lama</div>
                </div>
            </aside>
        </section>
    </div>
</div>
