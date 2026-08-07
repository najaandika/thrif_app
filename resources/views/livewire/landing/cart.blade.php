<div class="mx-auto max-w-6xl px-4 pb-28 pt-6 sm:px-6 lg:px-8 lg:pb-14 lg:pt-10">
    @if (session()->has('error'))
        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-700" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <div class="mb-7 grid gap-4 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-end">
            <div>
                <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-slate-950"></span>
                    Keranjang
                </p>
                <h1 class="mt-4 max-w-2xl text-3xl font-extrabold leading-[1.02] tracking-[-0.05em] text-slate-950 sm:text-5xl">
                    Cek item sebelum bayar.
                </h1>
                <p class="mt-4 max-w-xl text-sm font-medium leading-7 text-slate-600">
                    Pastikan item dan ukuran sudah cocok. Setelah itu isi kontak, pilih pengiriman, lalu checkout.
                </p>
            </div>

            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-[0_18px_50px_rgba(15,23,42,0.05)]">
                <div class="grid grid-cols-2 divide-x divide-slate-100 text-center">
                    <div class="px-2">
                        <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Item</p>
                        <p class="mt-1 text-2xl font-extrabold text-slate-950">{{ count($cartItems) }}</p>
                    </div>
                    <div class="px-2">
                        <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Total</p>
                        <p class="mt-1 text-lg font-extrabold text-slate-950">{{ rupiah($total) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="{{ count($cartItems) > 0 ? 'grid gap-6 lg:grid-cols-[minmax(0,0.95fr)_minmax(420px,1.05fr)] lg:items-start' : 'mx-auto max-w-xl' }}">
        <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_18px_60px_rgba(15,23,42,0.06)]">
            @if(count($cartItems) > 0)
                <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div>
                        <h2 class="text-lg font-extrabold tracking-tight text-slate-950">Item dipilih</h2>
                        <p class="mt-1 text-xs font-semibold text-slate-500">Stok thrift terbatas satuan.</p>
                    </div>
                    <a href="{{ route('landing.products.index') }}" class="hidden rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-600 transition hover:border-slate-300 hover:text-slate-950 sm:inline-flex">
                        Tambah item
                    </a>
                </div>

                <ul class="divide-y divide-slate-100">
                    @foreach($cartItems as $key => $item)
                        <li class="grid grid-cols-[5.25rem_minmax(0,1fr)] gap-3 p-4 transition hover:bg-slate-50/60 sm:grid-cols-[6.5rem_minmax(0,1fr)] sm:gap-4 sm:p-6">
                            <div class="relative aspect-square overflow-hidden rounded-[1.25rem] border border-slate-200 bg-slate-100">
                                @if(isset($item['image']) && $item['image'])
                                    <img src="{{ media_url($item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover object-center">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-[11px] font-bold text-slate-400">No Img</div>
                                @endif
                                @if(isset($item['is_on_sale']) && $item['is_on_sale'])
                                    <span class="absolute left-2 top-2 rounded-full bg-red-600 px-2 py-0.5 text-[10px] font-bold text-white shadow-sm">-{{ $item['discount_percent'] }}%</span>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <h3 class="line-clamp-2 text-sm font-bold leading-snug tracking-[-0.015em] text-slate-950 sm:text-base">{{ Str::title($item['name']) }}</h3>
                                        <div class="mt-2 flex flex-wrap gap-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                            <span>Qty {{ $item['quantity'] }}</span>
                                            <span>Size {{ $item['size'] ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <button type="button" wire:click="removeFromCart({{ $key }})" class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-400 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600" aria-label="Hapus {{ $item['name'] }} dari keranjang">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path d="M4 7h16M10 11v6M14 11v6M6 7l1 14h10l1-14M9 7V4h6v3" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="mt-3 flex items-end justify-between gap-3">
                                    <div>
                                        @if(isset($item['is_on_sale']) && $item['is_on_sale'])
                                            <p class="text-xs font-semibold text-slate-400 line-through">{{ rupiah($item['original_price']) }}</p>
                                            <p class="text-base font-extrabold text-red-600">{{ rupiah($item['price']) }}</p>
                                        @else
                                            <p class="text-base font-extrabold text-slate-950">{{ rupiah($item['price']) }}</p>
                                        @endif
                                    </div>
                                    <p class="rounded-full border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.12em] text-emerald-700">Siap order</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="border-t border-slate-100 p-5 sm:hidden">
                    <a href="{{ route('landing.products.index') }}" class="inline-flex h-11 w-full items-center justify-center rounded-2xl border border-slate-200 bg-white text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                        Tambah item lain
                    </a>
                </div>
            @else
                <div class="relative overflow-hidden px-5 py-10 text-center sm:px-8 sm:py-12">
                    <div class="absolute inset-x-8 top-6 h-20 rounded-full bg-slate-100 blur-3xl"></div>
                    <div class="relative mx-auto flex h-16 w-16 items-center justify-center rounded-[1.25rem] border border-slate-200 bg-white shadow-lg shadow-slate-950/8">
                        <svg class="h-7 w-7 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M6 8h15l-2 9H8L6 8ZM6 8 5 4H2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="18" cy="20" r="1" />
                        </svg>
                    </div>
                    <h2 class="relative mt-5 text-2xl font-extrabold tracking-[-0.035em] text-slate-950 sm:text-3xl">Keranjang masih kosong.</h2>
                    <p class="relative mx-auto mt-3 max-w-sm text-sm font-medium leading-7 text-slate-500">Pilih item yang masih ready, lalu checkout saat detail produk sudah cocok.</p>

                    <div class="relative mx-auto mt-6 grid max-w-sm grid-cols-3 divide-x divide-slate-100 rounded-2xl border border-slate-200 bg-slate-50/80 px-2 py-3 text-center">
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Stok</p>
                            <p class="mt-1 text-xs font-semibold text-slate-950">Satuan</p>
                        </div>
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Kondisi</p>
                            <p class="mt-1 text-xs font-semibold text-slate-950">Dicek</p>
                        </div>
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">Order</p>
                            <p class="mt-1 text-xs font-semibold text-slate-950">Cepat</p>
                        </div>
                    </div>

                    <a href="{{ route('landing.products.index') }}" class="relative mt-6 inline-flex h-11 items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 text-sm font-bold text-white shadow-lg shadow-slate-950/12 transition hover:-translate-y-0.5 hover:bg-slate-800">
                        Buka katalog
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            @endif
        </section>

        @if(count($cartItems) > 0)
            <section class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_18px_60px_rgba(15,23,42,0.06)] sm:p-6 lg:sticky lg:top-24" x-data="{
                deliveryMethod: 'shipping',
                paymentMethod: 'cash',
                buyerName: @entangle('buyerName'),
                buyerContact: @entangle('buyerContact'),
                shippingAddress: @entangle('shippingAddress'),
                notes: @entangle('notes')
            }">
                <div class="mb-6 flex items-start justify-between gap-4">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Checkout</p>
                        <h2 class="mt-2 text-2xl font-extrabold tracking-[-0.03em] text-slate-950">Checkout keranjang.</h2>
                    </div>
                    <span class="rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-emerald-700">Ready</span>
                </div>

                <form wire:submit="checkout" class="space-y-6">
                    <div class="space-y-3">
                        <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Metode</p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <label class="cursor-pointer">
                                <input type="radio" name="delivery_type" wire:model="deliveryType" value="shipping" x-model="deliveryMethod" class="peer sr-only">
                                <span class="block rounded-2xl border border-slate-200 bg-white p-4 transition peer-checked:border-slate-950 peer-checked:bg-slate-50">
                                    <span class="block text-sm font-bold text-slate-950">Pesan antar</span>
                                    <span class="mt-1 block text-xs font-medium leading-5 text-slate-500">Kurir toko atau ekspedisi.</span>
                                </span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="delivery_type" wire:model="deliveryType" value="pickup" x-model="deliveryMethod" class="peer sr-only">
                                <span class="block rounded-2xl border border-slate-200 bg-white p-4 transition peer-checked:border-slate-950 peer-checked:bg-slate-50">
                                    <span class="block text-sm font-bold text-slate-950">Ambil toko</span>
                                    <span class="mt-1 block text-xs font-medium leading-5 text-slate-500">Gratis ongkir.</span>
                                </span>
                            </label>
                        </div>

                        <label class="block">
                            <span class="mb-1.5 block text-sm font-bold text-slate-700">Pembayaran</span>
                            <select name="payment_method" wire:model="paymentMethod" x-model="paymentMethod" class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 outline-none transition focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10">
                                <option value="cash" x-text="deliveryMethod === 'pickup' ? 'Bayar di toko (Cash / QRIS)' : 'Cash on Delivery'"></option>
                                <option value="midtrans">Midtrans (Transfer / QRIS)</option>
                            </select>
                            @error('paymentMethod') <span class="mt-1 block text-xs font-bold text-red-600">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <div class="space-y-3">
                        <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Data pembeli</p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <label class="block">
                                <span class="mb-1.5 block text-sm font-bold text-slate-700">Nama penerima</span>
                                <input type="text" id="buyerName" name="buyer_name" x-model="buyerName" autocomplete="name" class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10">
                                @error('buyerName') <span class="mt-1 block text-xs font-bold text-red-600">{{ $message }}</span> @enderror
                            </label>
                            <label class="block">
                                <span class="mb-1.5 block text-sm font-bold text-slate-700">Kontak WA / IG</span>
                                <input type="text" id="buyerContact" name="buyer_contact" x-model="buyerContact" autocomplete="tel" class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10">
                                @error('buyerContact') <span class="mt-1 block text-xs font-bold text-red-600">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Pengiriman</p>
                        <label class="block" x-show="deliveryMethod === 'shipping'" x-transition>
                            <span class="mb-1.5 block text-sm font-bold text-slate-700">Alamat pengiriman</span>
                            <textarea id="shippingAddress" name="shipping_address" x-model="shippingAddress" rows="3" placeholder="Tulis alamat lengkap untuk cek ongkir" autocomplete="street-address" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold leading-6 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10"></textarea>
                            @error('shippingAddress') <span class="mt-1 block text-xs font-bold text-red-600">{{ $message }}</span> @enderror
                        </label>
                        <label class="block">
                            <span class="mb-1.5 block text-sm font-bold text-slate-700">Catatan opsional</span>
                            <textarea id="notes" name="notes" x-model="notes" rows="2" placeholder="Contoh: warna/packing, patokan alamat, atau request lain" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold leading-6 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10"></textarea>
                        </label>
                    </div>

                    <div class="rounded-[1.5rem] border border-slate-200 bg-slate-950 p-4 text-white">
                        <div class="space-y-2 text-sm font-semibold text-white/70">
                            <div class="flex items-center justify-between gap-4">
                                <span>Subtotal</span>
                                @if($originalTotal > $total)
                                    <span class="text-white/45 line-through">{{ rupiah($originalTotal) }}</span>
                                @else
                                    <span class="text-white">{{ rupiah($total) }}</span>
                                @endif
                            </div>
                            @if($originalTotal > $total)
                                <div class="flex items-center justify-between gap-4 text-red-200">
                                    <span>Diskon produk</span>
                                    <span>-{{ rupiah($originalTotal - $total) }}</span>
                                </div>
                            @endif
                            <div class="border-t border-white/10 pt-3">
                                <div class="flex items-end justify-between gap-4">
                                    <span class="font-bold text-white/80">Total bayar</span>
                                    <span class="text-2xl font-extrabold tracking-[-0.04em] text-white">{{ rupiah($total) }}</span>
                                </div>
                                <p class="mt-2 text-xs font-medium leading-5 text-white/55">Ongkir dan konfirmasi final mengikuti metode pengiriman yang dipilih.</p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="inline-flex min-h-[3.25rem] w-full items-center justify-center gap-2 rounded-2xl bg-slate-950 px-6 py-4 text-base font-bold text-white shadow-xl shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800 disabled:cursor-not-allowed disabled:opacity-50">
                        Lanjut Checkout
                        <span aria-hidden="true">&rarr;</span>
                    </button>
                </form>
            </section>
        @endif
    </div>

    <form id="finalize-form" action="{{ route('landing.cart.finalize') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="buyer_name" value="{{ $buyerName }}">
        <input type="hidden" name="buyer_contact" value="{{ $buyerContact }}">
        <input type="hidden" name="shipping_address" value="{{ $shippingAddress }}">
        <input type="hidden" name="notes" value="{{ $notes }}">
        <input type="hidden" name="payment_result" id="payment-result-input">
    </form>

    @vite(['resources/js/cart-checkout.js'])
</div>




