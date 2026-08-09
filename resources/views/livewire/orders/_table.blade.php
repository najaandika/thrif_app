@php
    $statusBadge = function ($order) {
        return match ($order->status) {
            'pending' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
            'paid' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
            default => 'bg-slate-100 text-slate-600 ring-1 ring-slate-200',
        };
    };
@endphp

<div class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white lg:block">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Invoice</th>
                <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Produk</th>
                <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Pembeli</th>
                <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Total</th>
                <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Status</th>
                <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Update</th>
                <th class="px-5 py-4 text-right text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($orders as $order)
                <tr class="transition hover:bg-slate-50/80">
                    <td class="px-5 py-4">
                        <p class="font-mono text-sm font-extrabold text-slate-950">{{ $order->invoice_number }}</p>
                        <p class="mt-1 text-xs font-bold uppercase tracking-[0.12em] text-slate-400">{{ $order->type ?? 'online' }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <p class="max-w-52 truncate text-sm font-extrabold text-slate-900">{{ $order->product_name ?? '-' }}</p>
                        @if($order->items->count() > 1)
                            <p class="mt-1 text-xs font-bold text-slate-400">+ {{ $order->items->count() - 1 }} item lainnya</p>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <p class="text-sm font-extrabold text-slate-900">{{ $order->buyer_name ?: 'Customer' }}</p>
                        <p class="mt-1 text-xs font-bold text-slate-400">{{ $order->buyer_contact ?: '-' }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <p class="text-sm font-extrabold text-slate-950">{{ rupiah($order->total_price) }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-extrabold {{ $statusBadge($order) }}">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <p class="text-xs font-bold text-slate-500">{{ $order->updated_at->diffForHumans() }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" wire:click="viewOrder({{ $order->id }})" class="inline-flex h-9 items-center rounded-xl bg-slate-950 px-3 text-xs font-extrabold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200">
                                Detail
                            </button>
                            @if($order->status === 'pending')
                                <form wire:submit.prevent="confirmOrder({{ $order->id }})">
                                    <button type="submit" class="inline-flex h-9 items-center rounded-xl bg-emerald-50 px-3 text-xs font-extrabold text-emerald-700 ring-1 ring-emerald-200 transition hover:bg-emerald-100 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                        Konfirmasi
                                    </button>
                                </form>
                            @endif
                            <button type="button" onclick="confirmDelete({{ $order->id }})" class="inline-flex h-9 items-center rounded-xl bg-rose-50 px-3 text-xs font-extrabold text-rose-700 ring-1 ring-rose-200 transition hover:bg-rose-100 focus:outline-none focus:ring-4 focus:ring-rose-100">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 ring-1 ring-slate-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h10a2 2 0 012 2v16l-3-2-2 2-2-2-2 2-2-2-3 2V5a2 2 0 012-2Z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-lg font-extrabold text-slate-950">Belum ada order.</p>
                        <p class="mt-1 text-sm font-bold text-slate-500">Order dari landing page atau POS akan tampil di sini.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="space-y-3 lg:hidden">
    @forelse ($orders as $order)
        <article class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="font-mono text-xs font-extrabold text-slate-400">{{ $order->invoice_number }}</p>
                    <h3 class="mt-2 line-clamp-2 text-base font-extrabold tracking-[-0.02em] text-slate-950">{{ $order->product_name ?? '-' }}</h3>
                </div>
                <span class="shrink-0 rounded-full px-3 py-1 text-[11px] font-extrabold {{ $statusBadge($order) }}">
                    {{ $order->status === 'pending' ? 'Pending' : $order->status_label }}
                </span>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-2">
                <div class="rounded-2xl bg-slate-50 p-3">
                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Pembeli</p>
                    <p class="mt-1 truncate text-sm font-extrabold text-slate-950">{{ $order->buyer_name ?: 'Customer' }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-3">
                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Total</p>
                    <p class="mt-1 text-sm font-extrabold text-slate-950">{{ rupiah($order->total_price) }}</p>
                </div>
            </div>

            <div class="mt-4 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
                <p class="text-xs font-bold text-slate-400">{{ strtoupper($order->type ?? 'online') }} · {{ $order->updated_at->diffForHumans() }}</p>
                <div class="flex items-center gap-2">
                    <button type="button" wire:click="viewOrder({{ $order->id }})" class="inline-flex h-10 items-center rounded-xl bg-slate-950 px-4 text-xs font-extrabold text-white shadow-sm">
                        Detail
                    </button>
                    @if($order->status === 'pending')
                        <form wire:submit.prevent="confirmOrder({{ $order->id }})">
                            <button type="submit" class="inline-flex h-10 items-center rounded-xl bg-emerald-50 px-4 text-xs font-extrabold text-emerald-700 ring-1 ring-emerald-200">
                                Lunas
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </article>
    @empty
        <div class="rounded-3xl border border-slate-200 bg-white px-5 py-12 text-center shadow-sm">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 ring-1 ring-slate-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h10a2 2 0 012 2v16l-3-2-2 2-2-2-2 2-2-2-3 2V5a2 2 0 012-2Z" />
                </svg>
            </div>
            <p class="mt-4 text-lg font-extrabold text-slate-950">Belum ada order.</p>
            <p class="mt-1 text-sm font-bold text-slate-500">Coba ubah filter atau tunggu transaksi baru masuk.</p>
        </div>
    @endforelse
</div>
