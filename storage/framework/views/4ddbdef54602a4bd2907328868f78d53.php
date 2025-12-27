<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!--[if BLOCK]><![endif]--><?php if(session()->has('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('error')); ?></span>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="<?php echo e(count($cartItems) > 0 ? 'lg:grid lg:grid-cols-[0.85fr,1.15fr] gap-6 lg:items-start' : 'max-w-xl mx-auto'); ?>">
        <section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-6 h-fit relative overflow-hidden">
            <!--[if BLOCK]><![endif]--><?php if(count($cartItems) > 0): ?>
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">Keranjang Belanja</h2>
                    <span class="text-xs font-medium bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 px-2.5 py-1 rounded-full"><?php echo e(count($cartItems)); ?> Item</span>
                </div>

                <div class="space-y-6">
                    <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex py-4 first:pt-0 last:pb-0 gap-4">
                                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 relative">
                                    <!--[if BLOCK]><![endif]--><?php if(isset($item['image']) && $item['image']): ?>
                                        <img src="<?php echo e(Storage::url($item['image'])); ?>" alt="<?php echo e($item['name']); ?>" class="h-full w-full object-cover object-center">
                                    <?php else: ?>
                                        <div class="h-full w-full flex items-center justify-center text-xs text-gray-400">
                                            No Img
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <!--[if BLOCK]><![endif]--><?php if(isset($item['is_on_sale']) && $item['is_on_sale']): ?>
                                        <div class="absolute top-1 left-1 bg-gradient-to-r from-red-500 to-orange-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full shadow">
                                            -<?php echo e($item['discount_percent']); ?>%
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div class="flex flex-1 flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between text-base font-medium text-gray-900 dark:text-gray-100">
                                            <h3 class="line-clamp-2 leading-snug">
                                                <a href="#"><?php echo e($item['name']); ?></a>
                                            </h3>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Size: <?php echo e($item['size'] ?? '-'); ?></p>
                                    </div>
                                    <div class="flex items-end justify-between text-sm">
                                        <div>
                                            <!--[if BLOCK]><![endif]--><?php if(isset($item['is_on_sale']) && $item['is_on_sale']): ?>
                                                <p class="text-xs text-gray-400 line-through"><?php echo e(rupiah($item['original_price'])); ?></p>
                                                <p class="font-bold text-red-500 font-mono"><?php echo e(rupiah($item['price'])); ?></p>
                                            <?php else: ?>
                                                <p class="font-bold text-emerald-600 dark:text-emerald-400 font-mono"><?php echo e(rupiah($item['price'])); ?></p>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <p class="text-gray-500 dark:text-gray-400">Qty <?php echo e($item['quantity']); ?></p>
                                            <button type="button" wire:click="removeFromCart(<?php echo e($key); ?>)" class="font-medium text-red-500 hover:text-red-600 transition-colors p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20">
                                                <span class="sr-only">Remove</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </ul>
                </div>
            <?php else: ?>
                <div class="text-center py-16 px-4">
                    <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none">
                        <div class="w-64 h-64 bg-emerald-500 rounded-full blur-3xl"></div>
                    </div>

                    <div class="relative bg-gray-50 dark:bg-gray-800 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 ring-4 ring-gray-50 dark:ring-gray-800">
                        <svg class="h-10 w-10 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Keranjang masih kosong</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-xs mx-auto">Yuk isi dengan barang-barang favoritmu sebelum kehabisan!</p>
                    
                    <div class="mt-8">
                        <a href="<?php echo e(route('landing.products.index')); ?>" class="group relative inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-8 py-3.5 text-sm font-bold text-white shadow-xl shadow-emerald-600/20 transition-all duration-300 hover:bg-emerald-500 hover:scale-[1.02] hover:shadow-2xl hover:shadow-emerald-600/40">
                            <span>Mulai Belanja</span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </section>

        <!--[if BLOCK]><![endif]--><?php if(count($cartItems) > 0): ?>
        <section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 h-fit" x-data="{ 
            deliveryMethod: 'shipping', 
            paymentMethod: 'cash',
            buyerName: <?php if ((object) ('buyerName') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('buyerName'->value()); ?>')<?php echo e('buyerName'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('buyerName'); ?>')<?php endif; ?>,
            buyerContact: <?php if ((object) ('buyerContact') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('buyerContact'->value()); ?>')<?php echo e('buyerContact'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('buyerContact'); ?>')<?php endif; ?>,
            shippingAddress: <?php if ((object) ('shippingAddress') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('shippingAddress'->value()); ?>')<?php echo e('shippingAddress'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('shippingAddress'); ?>')<?php endif; ?>,
            notes: <?php if ((object) ('notes') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('notes'->value()); ?>')<?php echo e('notes'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('notes'); ?>')<?php endif; ?>
        }">
            <div class="space-y-1 mb-6">
                <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Form Pembelian</p>
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Isi data pengirimanmu</h2>
            </div>
            
            <div>
                <form wire:submit="checkout" class="space-y-6">
                    <div class="space-y-3">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pengiriman</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer relative">
                                    <input type="radio" wire:model="deliveryType" value="shipping" x-model="deliveryMethod" class="peer sr-only">
                                    <div class="rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 peer-checked:border-slate-900 peer-checked:bg-slate-50 dark:peer-checked:border-slate-400 dark:peer-checked:bg-slate-900/50 transition-all text-center">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Pesan Antar</div>
                                        <div class="text-xs text-gray-500 mt-0.5">Kurir Toko (Balam) / Ekspedisi</div>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" wire:model="deliveryType" value="pickup" x-model="deliveryMethod" class="peer sr-only">
                                    <div class="rounded-xl border border-gray-200 dark:border-gray-700 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 peer-checked:border-slate-900 peer-checked:bg-slate-50 dark:peer-checked:border-slate-400 dark:peer-checked:bg-slate-900/50 transition-all text-center">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Ambil di Toko</div>
                                        <div class="text-xs text-gray-500 mt-0.5">Gratis Ongkir</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran</label>
                            <select wire:model="paymentMethod" class="w-full rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-gray-100 transition-all duration-300 focus:border-slate-900 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-900/20 dark:focus:ring-slate-500/20 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none">
                                <option value="cash" x-text="deliveryMethod === 'pickup' ? 'Bayar di Toko (Cash / QRIS)' : 'Cash On Delivery'"></option>
                                <option value="midtrans">Midtrans (Transfer / QRIS)</option>
                            </select>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['paymentMethod'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>

                    <div class="pt-2"></div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-xl bg-slate-900 text-slate-100 dark:bg-slate-800 dark:text-slate-100 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <span class="text-xs font-bold tracking-wider text-gray-500 uppercase">Data Pembeli</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label for="buyerName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama penerima</label>
                                <input type="text" id="buyerName" x-model="buyerName" class="w-full rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-gray-100 transition-all duration-300 focus:border-slate-900 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-900/20 dark:focus:ring-slate-500/20 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['buyerName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
        
                            <div class="space-y-1">
                                <label for="buyerContact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kontak (WA / IG)</label>
                                <input type="text" id="buyerContact" x-model="buyerContact" class="w-full rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-gray-100 transition-all duration-300 focus:border-slate-900 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-900/20 dark:focus:ring-slate-500/20 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['buyerContact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                         <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="text-xs font-bold tracking-wider text-gray-500 uppercase">Detail Pengiriman</span>
                        </div>

                        <div class="space-y-1" x-show="deliveryMethod === 'shipping'" x-transition>
                            <label for="shippingAddress" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat pengiriman</label>
                            <textarea id="shippingAddress" x-model="shippingAddress" rows="3" placeholder="Tulis alamat lengkap (Kecamatan & Kota wajib diisi untuk cek ongkir)" class="w-full rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-gray-100 transition-all duration-300 focus:border-slate-900 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-900/20 dark:focus:ring-slate-500/20 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none"></textarea>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['shippingAddress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        
                        <div class="space-y-1">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan (Opsional)</label>
                            <textarea id="notes" x-model="notes" rows="2" class="w-full rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 text-sm text-gray-900 dark:text-gray-100 transition-all duration-300 focus:border-slate-900 dark:focus:border-slate-500 focus:ring-4 focus:ring-slate-900/20 dark:focus:ring-slate-500/20 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <p class="text-[11px] font-semibold tracking-[0.2em] text-gray-500 dark:text-gray-400 uppercase">Ringkasan Order</p>
                        </div>
                        <div class="rounded-2xl border-2 border-gray-200 dark:border-gray-700 p-5 bg-gradient-to-br from-gray-50 to-gray-100/50 dark:from-gray-800/40 dark:to-gray-800/20 space-y-4 text-sm text-gray-600 dark:text-gray-300">
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
                                <!--[if BLOCK]><![endif]--><?php if($originalTotal > $total): ?>
                                    <div class="text-right">
                                        <span class="text-xs text-gray-400 line-through block"><?php echo e(rupiah($originalTotal)); ?></span>
                                        <span class="font-bold text-lg text-red-500"><?php echo e(rupiah($total)); ?></span>
                                    </div>
                                <?php else: ?>
                                    <span class="font-bold text-lg text-emerald-600 dark:text-emerald-400"><?php echo e(rupiah($total)); ?></span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <!--[if BLOCK]><![endif]--><?php if($originalTotal > $total): ?>
                                <div class="text-right mt-1">
                                    <span class="text-xs text-red-500 font-medium">Kamu hemat <?php echo e(rupiah($originalTotal - $total)); ?>!</span>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="group w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-gray-800 px-6 py-4 text-base font-bold text-white shadow-xl shadow-gray-900/40 transition-all duration-300 hover:bg-gray-700 hover:scale-[1.02] hover:shadow-2xl hover:shadow-gray-900/60 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5 text-emerald-400 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Checkout Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </section>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <form id="finalize-form" action="<?php echo e(route('landing.cart.finalize')); ?>" method="POST" class="hidden">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="buyer_name" value="<?php echo e($buyerName); ?>">
        <input type="hidden" name="buyer_contact" value="<?php echo e($buyerContact); ?>">
        <input type="hidden" name="shipping_address" value="<?php echo e($shippingAddress); ?>">
        <input type="hidden" name="notes" value="<?php echo e($notes); ?>">
        <input type="hidden" name="payment_result" id="payment-result-input">
    </form>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/cart-checkout.js']); ?>
</div>
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/landing/cart.blade.php ENDPATH**/ ?>