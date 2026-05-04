<div class="profile-section">
    <?php if(session()->has('addressSaved')): ?>
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            <?php echo e(session('addressSaved')); ?>

        </div>
    <?php endif; ?>

    <form wire:submit.prevent="save" class="profile-section">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Nama penerima</label>
                <input type="text" id="recipient_name" name="recipient_name" wire:model.defer="recipient_name" class="w-full rounded-xl border-2 border-gray-200 px-4 py-2.5 text-sm focus:border-slate-600 focus:ring-2 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" placeholder="Nama lengkap" />
                <?php $__errorArgs = ['recipient_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm font-semibold text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Nomor kontak</label>
                <input type="text" id="phone" name="phone" wire:model.defer="phone" class="w-full rounded-xl border-2 border-gray-200 px-4 py-2.5 text-sm focus:border-slate-600 focus:ring-2 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" placeholder="08xxxxxxxxxx" />
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm font-semibold text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Alamat lengkap</label>
            <textarea id="address_line" name="address_line" wire:model.defer="address_line" rows="3" class="w-full rounded-xl border-2 border-gray-200 px-4 py-2.5 text-sm focus:border-slate-600 focus:ring-2 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" placeholder="Nama jalan, nomor rumah, detail patokan"></textarea>
            <?php $__errorArgs = ['address_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-sm font-semibold text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500">Simpan alamat</button>

            <?php if($hasAddress && $lastUpdatedHuman): ?>
                <p class="text-sm text-gray-500 dark:text-gray-400">Terakhir diperbarui <?php echo e($lastUpdatedHuman); ?>.</p>
            <?php endif; ?>
        </div>
    </form>
</div><?php /**PATH C:\laragon\www\thrif\resources\views\livewire\profile\address-form.blade.php ENDPATH**/ ?>