<aside class="space-y-5 xl:sticky xl:top-24 xl:self-start">
    <div class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.08)]">
        <div class="border-b border-slate-200 p-5">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Transaksi</p>
                    <h2 class="mt-1 text-xl font-black text-slate-950">Keranjang</h2>
                </div>
                <span class="inline-flex h-10 min-w-10 items-center justify-center rounded-2xl bg-slate-950 px-3 text-sm font-black text-white">
                    {{ count($cart) }}
                </span>
            </div>
        </div>

        <div class="max-h-[22rem] overflow-y-auto p-4">
            @forelse ($cart as $item)
                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/70 p-3 shadow-sm">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white text-slate-500 ring-1 ring-slate-200">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-black text-slate-950">{{ $item['name'] }}</p>
                        <p class="mt-0.5 text-xs font-bold text-slate-500">Qty {{ $item['qty'] }} x {{ rupiah($item['price']) }}</p>
                    </div>
                    <div class="flex shrink-0 flex-col items-end gap-1">
                        <p class="text-sm font-black text-slate-950">{{ rupiah($item['price'] * $item['qty']) }}</p>
                        <button
                            type="button"
                            wire:click="removeFromCart({{ $item['id'] }})"
                            class="inline-flex h-8 w-8 items-center justify-center rounded-xl border border-red-100 bg-red-50 text-red-500 transition hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-100"
                            aria-label="Hapus {{ $item['name'] }} dari keranjang"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12m-10 0 .7 12.1A2 2 0 0 0 10.7 21h2.6a2 2 0 0 0 2-1.9L16 7M10 11v6m4-6v6M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-5 py-12 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-3xl bg-white text-slate-400 shadow-sm ring-1 ring-slate-200">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13 5.4 5M7 13l-2.3 2.3c-.6.6-.2 1.7.7 1.7H17m0 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8 2a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-base font-black text-slate-950">Keranjang kosong.</h3>
                    <p class="mt-2 text-sm font-semibold leading-6 text-slate-500">Pilih produk dari panel kiri untuk mulai transaksi POS.</p>
                </div>
            @endforelse
        </div>

        <div class="space-y-4 border-t border-slate-200 bg-slate-50/70 p-5">
            <div class="flex items-center justify-between text-sm font-bold text-slate-500">
                <span>Subtotal</span>
                <span class="text-slate-950">{{ rupiah($this->subtotal) }}</span>
            </div>

            <div class="rounded-3xl bg-slate-950 p-5 text-white shadow-[0_18px_45px_rgba(15,23,42,0.18)]">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Total bayar</p>
                <p class="mt-2 text-3xl font-black">{{ rupiah($this->total()) }}</p>
            </div>

            <div>
                <p class="mb-2 text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Metode pembayaran</p>
                <div class="grid grid-cols-2 gap-2 rounded-2xl border border-slate-200 bg-white p-1.5 shadow-sm">
                    <label class="group cursor-pointer">
                        <input type="radio" wire:model.live="payment_method" name="payment_method" value="cash" class="peer sr-only">
                        <span class="flex h-11 items-center justify-center gap-2 rounded-xl text-sm font-black text-slate-500 transition peer-checked:bg-slate-950 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-slate-100 group-hover:bg-slate-50 peer-checked:group-hover:bg-slate-950">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h.01M11 15h2M5 6h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2Z" />
                            </svg>
                            Tunai
                        </span>
                    </label>

                    <label class="group cursor-pointer">
                        <input type="radio" wire:model.live="payment_method" name="payment_method" value="qris" class="peer sr-only">
                        <span class="flex h-11 items-center justify-center gap-2 rounded-xl text-sm font-black text-slate-500 transition peer-checked:bg-slate-950 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-slate-100 group-hover:bg-slate-50 peer-checked:group-hover:bg-slate-950">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm11 0h2v2h-2v-2Zm4 0h1v5h-5v-1h4v-4Zm-4 4h2v2h-2v-2Z" />
                            </svg>
                            QRIS
                        </span>
                    </label>
                </div>
            </div>

            @if($payment_method === 'cash')
                <div>
                    <label for="amount_received" class="mb-2 block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Uang diterima</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-400">Rp</span>
                        <input
                            type="text"
                            x-data="currencyInput('{{ $amount_received }}', 'amount_received')"
                            x-on:input="update($event)"
                            :value="displayValue"
                            id="amount_received"
                            name="amount_received"
                            class="h-12 w-full rounded-2xl border border-slate-200 bg-white pl-11 pr-4 text-right text-base font-black text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100"
                            placeholder="0"
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                    <span class="text-sm font-extrabold text-emerald-700">Kembalian</span>
                    <span class="text-lg font-black text-emerald-700">{{ rupiah($this->change()) }}</span>
                </div>
            @endif
        </div>

        <div class="border-t border-slate-200 bg-white p-4">
            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="saveTransaction"
                class="inline-flex min-h-[3.35rem] w-full items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 text-base font-black text-white shadow-[0_18px_45px_rgba(15,23,42,0.18)] transition hover:-translate-y-0.5 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200 disabled:cursor-not-allowed disabled:bg-slate-300 disabled:text-slate-500 disabled:shadow-none disabled:hover:translate-y-0"
                @if(count($cart) == 0) disabled @endif
            >
                <svg wire:loading.remove wire:target="saveTransaction" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <svg wire:loading wire:target="saveTransaction" class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"></path>
                </svg>
                <span wire:loading.remove wire:target="saveTransaction">Simpan transaksi</span>
                <span wire:loading wire:target="saveTransaction">Menyimpan...</span>
            </button>
        </div>
    </div>
</aside>
