{{-- Ringkasan Order --}}
<div class="space-y-3">
    <div class="flex items-center gap-2">
        <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
        </div>
        <p class="text-[11px] font-semibold tracking-[0.2em] text-gray-500 dark:text-gray-400 uppercase">Ringkasan Order</p>
    </div>
    <div class="rounded-2xl border-2 border-gray-200 dark:border-gray-700 p-5 bg-gradient-to-br from-gray-50 to-gray-100/50 dark:from-gray-800/40 dark:to-gray-800/20 space-y-4 text-sm text-gray-600 dark:text-gray-300">
        
        <!-- Customer Info -->
        <div class="space-y-2">
            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Info Penerima</h4>
            <div class="flex justify-between">
                <span>Nama</span>
                <span class="font-medium text-gray-900 dark:text-gray-100 text-right" x-text="buyerName || '-'"></span>
            </div>
            <div class="flex justify-between">
                <span>Kontak</span>
                <span class="font-medium text-gray-900 dark:text-gray-100 text-right" x-text="buyerContact || '-'"></span>
            </div>
            
            <div x-show="deliveryMethod === 'shipping'" class="flex justify-between items-start gap-4">
                <span class="shrink-0">Alamat</span>
                <span class="font-medium text-gray-900 dark:text-gray-100 text-right line-clamp-2" x-text="shippingAddress || '-'"></span>
            </div>

        </div>

        <div class="border-b border-dashed border-gray-300 dark:border-gray-600"></div>

        <!-- Transaction Info -->
        <div class="space-y-2">
            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Transaksi</h4>
             <div class="flex justify-between">
                <span>Metode Kirim</span>
                <span class="font-medium text-gray-900 dark:text-gray-100" x-text="deliveryMethod === 'pickup' ? 'Ambil di Toko' : 'Pesan Antar'"></span>
            </div>
             <div class="flex justify-between">
                <span>Pembayaran</span>
                <span class="font-medium text-gray-900 dark:text-gray-100" x-text="paymentMethod === 'midtrans' ? 'Non-Tunai (Midtrans)' : (deliveryMethod === 'pickup' ? 'Bayar di Kasir' : 'COD')"></span>
            </div>
            
            <div x-show="notes" class="pt-2 border-t border-dashed border-gray-200 dark:border-gray-700">
                <span class="block text-[10px] text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Catatan</span>
                <p class="text-xs italic text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50 p-2 rounded-lg" x-text="notes"></p>
            </div>
        </div>
        
        <div class="border-b border-dashed border-gray-300 dark:border-gray-600"></div>

        <div class="flex items-center justify-between pt-1">
            <span class="font-medium">Total Harga</span>
            <span class="font-bold text-lg text-emerald-600 dark:text-emerald-400">{{ rupiah($product->price) }}</span>
        </div>
    </div>
</div>
