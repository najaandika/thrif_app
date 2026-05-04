<div class="h-full rounded-3xl border border-slate-300/80 dark:border-slate-700 bg-gradient-to-br from-slate-600 via-slate-700 to-slate-800/95 dark:from-slate-900/95 dark:via-slate-800/95 dark:to-slate-800/90 p-5 sm:p-6 space-y-4 relative overflow-hidden" id="kontak" data-section="contact">
    <!-- Decorative element -->
    <div class="absolute -left-8 -bottom-8 h-32 w-32 rounded-full bg-gradient-to-tr from-slate-700/20 via-slate-800/10 to-slate-500/10 blur-2xl"></div>
    
    <div class="space-y-2.5 relative z-10">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-xl bg-slate-800/80 border border-slate-700 flex items-center justify-center text-slate-100 shadow-lg shadow-slate-950/40">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold tracking-[0.2em] text-slate-300 uppercase">Kontak & Social</p>
            </div>
        </div>
    </div>
    
    <p class="text-[13px] text-slate-200/90 relative z-10">Order atau tanya stok terbaru bisa langsung via channel berikut:</p>
    
    <div class="flex flex-col gap-2.5 text-[13px] relative z-10">
          <?php if($shopPhone): ?>
          <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $shopPhone)); ?>"
              class="group inline-flex items-center gap-2.5 rounded-2xl bg-slate-900/90 hover:bg-slate-800 border border-slate-700 px-4 py-3 text-slate-50 font-semibold shadow-lg shadow-slate-950/40 transition-all duration-300 hover:scale-[1.02] hover:opacity-90">
                <div class="h-8 w-8 rounded-lg bg-emerald-500/15 border border-emerald-500/40 flex items-center justify-center text-emerald-400">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
            </div>
            <div class="flex-1 text-left">
                <div class="text-[11px] text-slate-300/90">WhatsApp</div>
                <div class="font-semibold tracking-wide"><?php echo e($shopPhone); ?></div>
            </div>
            <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
        <?php else: ?>
        <div class="rounded-xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 px-4 py-3 flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-xs text-amber-800 dark:text-amber-200 font-medium">Nomor WhatsApp belum tersedia. Silakan hubungi melalui Instagram.</p>
        </div>
        <?php endif; ?>
        
        <?php if($socialInstagram): ?>
        <a href="<?php echo e($socialInstagram); ?>"
           target="_blank"
           rel="noopener noreferrer"
           class="group inline-flex items-center gap-2.5 rounded-2xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-50 font-semibold shadow-lg shadow-slate-950/40 transition-all duration-300 hover:scale-[1.02] hover:bg-slate-800 hover:opacity-90">
            <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 flex items-center justify-center text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </div>
            <div class="flex-1 text-left">
                <div class="text-[11px] text-slate-300/90">Instagram</div>
                <div class="font-semibold tracking-wide"><?php echo e(parse_url($socialInstagram, PHP_URL_PATH) ?: '@yourshop'); ?></div>
            </div>
            <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
        <?php endif; ?>
        <?php if($socialTiktok): ?>
          <a href="<?php echo e($socialTiktok); ?>"
              target="_blank"
              rel="noopener noreferrer"
              class="group inline-flex items-center gap-2.5 rounded-2xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-50 font-semibold shadow-lg shadow-slate-950/40 transition-all duration-300 hover:scale-[1.02] hover:bg-slate-800 hover:opacity-90">
            <div class="h-8 w-8 rounded-lg bg-black flex items-center justify-center text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.165 8.165 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z"/>
                </svg>
            </div>
            <div class="flex-1 text-left">
                <div class="text-[11px] text-slate-300/90">TikTok</div>
                <div class="font-semibold tracking-wide"><?php echo e(parse_url($socialTiktok, PHP_URL_PATH) ?: '@yourshop'); ?></div>
            </div>
            <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
        <?php endif; ?>
        
        <?php if(auth()->guard()->guest()): ?>
            <div class="rounded-xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 px-4 py-3 flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xs text-amber-800 dark:text-amber-200 font-medium">Login/daftar untuk melakukan order, akses stok lengkap, dan riwayat penjualan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views\landing\sections\contact.blade.php ENDPATH**/ ?>