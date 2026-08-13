<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-3xl">
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Insight customer</p>
                <h1 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950 sm:text-4xl">Data pembeli.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Pantau akun customer, aktivitas order online, dan pembeli terbaru dari satu tempat.
                </p>
            </div>
            <div class="inline-flex w-fit items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-black text-slate-700 shadow-sm">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                Customer aktif
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Total customer</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.04em] text-slate-950">{{ $totalCustomers }}</p>
                <p class="mt-2 text-sm font-semibold text-slate-500">Akun pembeli terdaftar</p>
            </div>
            <div class="rounded-[1.5rem] border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-emerald-700">Order online</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.04em] text-slate-950">{{ $onlineOrders }}</p>
                <p class="mt-2 text-sm font-semibold text-emerald-800/70">Checkout dari landing</p>
            </div>
            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm xl:col-span-2">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Catatan admin</p>
                <p class="mt-4 max-w-2xl text-lg font-black leading-7 text-slate-950">
                    Customer yang rapi membantu proses follow-up order, alamat, dan riwayat pembelian.
                </p>
            </div>
        </section>

        <section class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
            <div class="flex flex-col gap-3 border-b border-slate-200 p-5 sm:flex-row sm:items-end sm:justify-between sm:p-6">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Daftar customer</p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Customer terbaru.</h2>
                </div>
                <span class="inline-flex w-fit items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-extrabold uppercase tracking-[0.14em] text-slate-500">
                    {{ $customers->count() }} tampil
                </span>
            </div>

            <div class="divide-y divide-slate-200">
                @forelse($customers as $customer)
                    <article class="flex flex-col gap-4 p-5 transition hover:bg-slate-50/70 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                        <div class="flex min-w-0 items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-950 text-sm font-black text-white shadow-sm">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="truncate text-base font-black text-slate-950">{{ $customer->name }}</h3>
                                <p class="mt-1 truncate text-sm font-semibold text-slate-500">{{ $customer->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 sm:justify-end">
                            <span class="inline-flex items-center whitespace-nowrap rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-extrabold leading-none text-emerald-700">
                                Customer
                            </span>
                            <span class="hidden text-xs font-bold text-slate-400 sm:inline">
                                {{ $customer->created_at?->format('d M Y') }}
                            </span>
                        </div>
                    </article>
                @empty
                    <div class="px-5 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 ring-1 ring-slate-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.941 3.199.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a5.971 5.971 0 0 0-.941 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <p class="mt-5 text-xl font-black tracking-[-0.03em] text-slate-950">Belum ada customer.</p>
                        <p class="mt-2 text-sm font-semibold text-slate-500">Customer baru akan tampil setelah register atau checkout.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
