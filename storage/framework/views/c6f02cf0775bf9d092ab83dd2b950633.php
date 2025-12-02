<!--[if BLOCK]><![endif]--><?php if($showDeleteModal): ?>
    <div class="modal-overlay" wire:click="$set('showDeleteModal', false)">
        <div class="modal-container" wire:click.stop>
            <div class="modal-header items-center justify-center">
                <div class="flex flex-col items-center text-center w-full">
                    <div class="w-16 h-16 rounded-full border border-orange-200 flex items-center justify-center mb-4 bg-orange-50">
                        <span class="text-4xl leading-none text-orange-400">!</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Yakin hapus data ini?</h3>
                    <p class="text-sm text-gray-500">Data yang dihapus tidak bisa dikembalikan!</p>
                </div>
            </div>

            <div class="modal-footer flex justify-center gap-3 mt-6">
                <button wire:click="deleteConfirmed" class="px-6 py-2 rounded-lg bg-red-600 text-white text-sm font-semibold shadow hover:bg-red-700">Ya, hapus!</button>
                <button wire:click="$set('showDeleteModal', false)" class="px-6 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold shadow hover:bg-blue-700">Batal</button>
            </div>
        </div>
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\laragon\www\thrif\resources\views/livewire/products/_delete-modal.blade.php ENDPATH**/ ?>