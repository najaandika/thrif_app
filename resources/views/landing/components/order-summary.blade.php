<div class="rounded-[1.5rem] border border-slate-200 bg-white p-3 shadow-sm">
    <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-slate-500 sm:grid-cols-4">
        <div class="rounded-2xl bg-slate-50 p-3">
            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Nama</p>
            <p class="mt-1 truncate text-sm font-bold text-slate-950" x-text="buyerName || '-'"></p>
        </div>
        <div class="rounded-2xl bg-slate-50 p-3">
            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Kontak</p>
            <p class="mt-1 truncate text-sm font-bold text-slate-950" x-text="buyerContact || '-'"></p>
        </div>
        <div class="rounded-2xl bg-slate-50 p-3">
            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Kirim</p>
            <p class="mt-1 text-sm font-bold text-slate-950" x-text="deliveryMethod === 'pickup' ? 'Ambil toko' : 'Antar'"></p>
        </div>
        <div class="rounded-2xl bg-slate-50 p-3">
            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Bayar</p>
            <p class="mt-1 text-sm font-bold text-slate-950" x-text="paymentMethod === 'midtrans' ? 'Midtrans' : (deliveryMethod === 'pickup' ? 'Toko' : 'COD')"></p>
        </div>
    </div>

    <div x-show="deliveryMethod === 'shipping'" class="mt-2 rounded-2xl bg-slate-50 p-3">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Alamat</p>
        <p class="mt-1 line-clamp-2 text-sm font-medium leading-6 text-slate-600" x-text="shippingAddress || '-'"></p>
    </div>

    <div x-show="notes" class="mt-2 rounded-2xl bg-slate-50 p-3">
        <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Catatan</p>
        <p class="mt-1 text-sm font-medium leading-6 text-slate-600" x-text="notes"></p>
    </div>

    <div class="mt-3 rounded-[1.25rem] border border-slate-200 bg-slate-950 p-4 text-white">
        <div class="flex items-center justify-between gap-4 text-sm font-semibold text-white/70">
            <span>Subtotal</span>
            @if($product->is_on_sale)
                <span class="line-through">{{ rupiah($product->price) }}</span>
            @else
                <span class="text-white">{{ rupiah($product->price) }}</span>
            @endif
        </div>
        @if($product->is_on_sale)
            <div class="mt-2 flex items-center justify-between gap-4 text-sm font-semibold text-red-200">
                <span>Diskon produk</span>
                <span>-{{ rupiah($product->price - $product->final_price) }}</span>
            </div>
        @endif
        <div class="mt-4 flex items-end justify-between gap-4 border-t border-white/10 pt-4">
            <span class="text-sm font-bold text-white/80">Total item</span>
            <span class="text-2xl font-extrabold tracking-[-0.04em] text-white">{{ rupiah($product->final_price) }}</span>
        </div>
        <p class="mt-2 text-xs font-medium leading-5 text-white/55">Ongkir dan finalisasi dikonfirmasi setelah data order masuk.</p>
    </div>
</div>
