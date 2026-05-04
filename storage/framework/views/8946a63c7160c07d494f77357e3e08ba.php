<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pembelian</title>
    <script>
        (function() {
            try {
                const stored = localStorage.getItem('darkMode');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (stored === 'true' || (stored === null && prefersDark)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        html, body { touch-action: pan-x pan-y; overscroll-behavior: none; overflow-x: hidden; }
    </style>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 font-sans" x-data>
    <div class="min-h-screen">
        <header class="bg-white/80 dark:bg-gray-900/80 border-b border-gray-200 dark:border-gray-800 backdrop-blur">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <nav class="text-xs font-medium text-gray-600 dark:text-gray-300 flex items-center gap-3">
                    <a href="/" class="hover:text-indigo-600 inline-flex items-center gap-1">
                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Home
                    </a>
                    <span class="text-gray-300 dark:text-gray-700">•</span>
                    <span class="text-indigo-600">Riwayat</span>
                </nav>
            </div>
        </header>

        <main class="py-12">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                <div class="space-y-1">
                    <p class="text-[10px] sm:text-[11px] font-semibold tracking-[0.2em] text-gray-500 dark:text-gray-400 uppercase">Riwayat pembelian</p>
                    <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-gray-100 leading-tight">Halo, <?php echo e($customer->name); ?> — ringkasan order kamu.</h1>
                </div>

                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <article class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm p-4 sm:p-5 flex flex-col md:flex-row gap-4 sm:gap-6">
                            <div class="flex-1 space-y-3">
                                <div class="flex items-center justify-between text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">
                                    <span class="font-mono bg-gray-100 dark:bg-gray-800 px-2 py-0.5 rounded"><?php echo e($order->invoice_number); ?></span>
                                    <span><?php echo e($order->created_at->translatedFormat('d M Y, H:i')); ?></span>
                                </div>
                                <div>
                                    <?php
                                        $firstItem = $order->items->first();
                                        $originalPrice = $firstItem->product->price ?? $firstItem->price;
                                        $wasDiscounted = $originalPrice > $firstItem->price;
                                    ?>
                                    <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-gray-100 leading-snug">
                                        <?php echo e($firstItem->product->name ?? 'Produk terhapus'); ?>

                                    </h2>
                                    <div class="flex items-center gap-2 mt-1 flex-wrap">
                                        <span class="text-xs sm:text-sm text-gray-500">(x<?php echo e($firstItem->quantity); ?>)</span>
                                        <?php if($order->items->count() > 1): ?>
                                            <span class="text-xs sm:text-sm text-gray-500">+<?php echo e($order->items->count() - 1); ?> lainnya</span>
                                        <?php endif; ?>
                                        <?php if($wasDiscounted && $firstItem->product && $firstItem->product->discount_percentage): ?>
                                            <span class="text-[10px] bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold">-<?php echo e(round($firstItem->product->discount_percentage)); ?>%</span>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                        $totalOriginalPrice = $order->items->sum(function($item) {
                                            return ($item->product->price ?? $item->price) * $item->quantity;
                                        });
                                        $hasSavings = $totalOriginalPrice > $order->total_price;
                                    ?>
                                    <div class="pt-2 flex items-center flex-wrap gap-1">
                                        <?php if($hasSavings): ?>
                                            <span class="text-xs text-gray-400 line-through"><?php echo e(rupiah($totalOriginalPrice)); ?></span>
                                            <span class="font-bold text-sm sm:text-base text-red-500"><?php echo e(rupiah($order->total_price)); ?></span>
                                            <span class="text-[10px] text-red-500 font-medium">Hemat <?php echo e(rupiah($totalOriginalPrice - $order->total_price)); ?></span>
                                        <?php else: ?>
                                            <span class="font-bold text-sm sm:text-base text-emerald-600 dark:text-emerald-400"><?php echo e(rupiah($order->total_price)); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="inline-flex items-center gap-2">
                                     <!-- Status Logic Same as Before -->
                                    <span class="px-3 py-1 rounded-full text-[10px] sm:text-xs font-semibold border <?php echo e($order->status_class); ?>">
                                        <?php echo e($order->status_label); ?>

                                    </span>
                                </div>
                            </div>
                            
                            <!-- Detail Section Refined -->
                            <div class="md:w-64 pt-4 md:pt-0 md:pl-6 border-t md:border-t-0 md:border-l border-gray-100 dark:border-gray-800 flex flex-col justify-between">
                                <div class="space-y-3">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">Info Pengiriman</p>
                                    
                                    <div class="grid grid-cols-2 md:grid-cols-1 gap-2">
                                        <div>
                                            <p class="text-[10px] text-gray-400 dark:text-gray-500">Penerima</p>
                                            <p class="text-xs font-medium text-gray-900 dark:text-gray-300 truncate"><?php echo e($order->buyer_name); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-400 dark:text-gray-500">Kontak</p>
                                            <p class="text-xs font-medium text-gray-900 dark:text-gray-300 truncate"><?php echo e($order->buyer_contact ?? '-'); ?></p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">Alamat</p>
                                        <?php if($order->shipping_address === 'AMBIL DI TOKO'): ?>
                                            <div class="mt-0.5">
                                                <p class="text-xs font-medium text-gray-900 dark:text-gray-300 leading-snug"><?php echo e(\App\Models\Setting::get('shop_address') ?? 'Alamat Toko'); ?></p>
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300 mt-1 border border-indigo-100 dark:border-indigo-800/50">
                                                    Ambil di Toko
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <p class="text-xs font-medium text-gray-900 dark:text-gray-300 leading-snug break-words"><?php echo e($order->shipping_address ?? 'Belum diisi'); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">Metode Bayar</p>
                                        <p class="text-xs font-medium text-gray-900 dark:text-gray-300">
                                            <?php if($order->payment_method === 'cash'): ?>
                                                <?php if($order->shipping_address === 'AMBIL DI TOKO'): ?>
                                                    Bayar di Kasir
                                                <?php else: ?>
                                                    COD
                                                <?php endif; ?>
                                            <?php else: ?>
                                                Non-Tunai
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    
                                    <?php if($order->notes): ?>
                                        <div>
                                            <p class="text-[10px] text-gray-400 dark:text-gray-500">Catatan</p>
                                            <p class="text-xs text-gray-700 dark:text-gray-400 italic truncate"><?php echo e($order->notes); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if($order->status !== 'pending'): ?>
                                <button 
                                    x-data 
                                    x-on:click="Livewire.dispatch('open-receipt-modal', { orderId: <?php echo e($order->id); ?> })"
                                    class="w-full mt-4 inline-flex items-center justify-center rounded-lg bg-indigo-50 border border-indigo-100 dark:bg-gray-800 dark:border-gray-700 px-3 py-2 text-xs font-semibold text-indigo-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-gray-700 transition-all active:scale-95"
                                >
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-indigo-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Lihat Struk
                                </button>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="rounded-3xl border border-dashed border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-900/60 p-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            Kamu belum memiliki order. Silakan kembali ke landing dan mulai belanja.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
    <?php if (isset($component)) { $__componentOriginal7cfab914afdd05940201ca0b2cbc009b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $attributes = $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $component = $__componentOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
    
    <?php if(session('status')): ?>
        <div data-checkout-status="<?php echo e(session('status')); ?>" data-checkout-redirect="<?php echo e(route('landing.orders.history')); ?>" style="display:none;"></div>
    <?php endif; ?>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('orders.customer-receipt-modal');

$__html = app('livewire')->mount($__name, $__params, 'lw-576341317-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\thrif\resources\views\landing\history.blade.php ENDPATH**/ ?>