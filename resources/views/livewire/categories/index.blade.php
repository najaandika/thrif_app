<div class="admin-wrapper">
        @if (session()->has('message'))
            <x-alert :message="session('message')" type="success" />
        @endif

        <div class="admin-layout">
            <x-sidebar />

            <!-- Main Content -->
            <div class="admin-content">
                <div class="admin-card">
                    <div class="admin-card-body">
                        <div class="admin-header-simple">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input wire:model.live="search" id="category_search" name="category_search" type="text" placeholder="Search categories..." class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
                            </div>
                            <a href="{{ route('categories.create') }}" class="btn-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Category
                            </a>
                        </div>

                        <div class="admin-table-container">
                            <table class="admin-table">
                                <thead class="admin-thead">
                                    <tr>
                                        <th class="admin-th">Name</th>
                                        <th class="admin-th text-center">Jumlah Produk</th>
                                        <th class="admin-th-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="admin-tbody">
                                    @forelse ($categories as $category)
                                        <tr class="admin-tr">
                                            <td class="admin-td">
                                                <div class="text-primary">{{ $category->name }}</div>
                                            </td>
                                            <td class="admin-td text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200">
                                                    {{ $category->products_count }} produk
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="{{ route('categories.edit', $category) }}" class="btn-action-edit">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <button type="button" onclick="confirmDelete({{ $category->id }})" class="btn-action-delete">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="empty-state">
                                                No categories found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination-wrapper">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

