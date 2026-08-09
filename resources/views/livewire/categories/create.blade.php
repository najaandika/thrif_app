<div class="py-10 lg:py-12">
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
            <div class="admin-form-shell">
                <div class="admin-form-header">
                    <div class="min-w-0">
                        <nav class="admin-breadcrumb" aria-label="Breadcrumb">
                            <a href="{{ route('categories.index') }}">Kategori</a>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Tambah</span>
                        </nav>

                        <h2 class="admin-form-title">Tambah Kategori</h2>
                        <p class="admin-form-subtitle">Gunakan nama yang singkat dan mudah dipahami pembeli, seperti Hoodie, Shirt, atau Outerwear.</p>
                    </div>

                    <div class="admin-form-icon" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                </div>

                <div class="admin-form-card">
                    <form wire:submit="save" id="categoryForm" class="space-y-6">
                        <div>
                            <label for="name" class="admin-field-label">
                                Nama kategori <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input
                                    wire:model="name"
                                    name="name"
                                    autocomplete="off"
                                    type="text"
                                    id="name"
                                    placeholder="Contoh: Hoodie, Shirt, Jacket"
                                    class="admin-text-input pr-11"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="admin-field-help">Kategori akan tampil di filter katalog dan form produk.</p>
                            @error('name')
                                <span class="admin-field-error">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </form>

                    <div class="admin-form-actions">
                        <a href="{{ route('categories.index') }}" class="admin-btn-secondary">Batal</a>
                        <button type="submit" form="categoryForm" class="admin-btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Kategori
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

