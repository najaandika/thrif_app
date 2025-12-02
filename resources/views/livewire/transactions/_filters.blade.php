<div class="mb-6 flex flex-col lg:flex-row gap-4 lg:items-center justify-between">
    <div class="flex flex-col sm:flex-row gap-4 flex-1">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input
                wire:model.live="search"
                type="text"
                placeholder="Cari ID / metode / status"
                class="w-full pl-12 pr-4 py-3 border border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-1 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200 shadow-sm hover:shadow-md"
            >
        </div>
        <div class="w-auto">
            <select
                wire:model.live="paymentMethod"
                class="pl-4 pr-11 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 appearance-none bg-no-repeat bg-[length:0.75em] bg-[right_1rem_center]"
                style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27%236b7280%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E');"
            >
                <option value="all">Semua</option>
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
                <option value="ewallet">Qris</option>
            </select>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full lg:w-auto">
        <div class="flex flex-row gap-2">
            <form action="{{ route('transactions.export.excel') }}" method="GET" class="inline-block">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h5M4 4h16v6l-4 10H8L4 10V4z" />
                    </svg>
                    Export Excel
                </button>
            </form>
            <form action="{{ route('transactions.export.pdf') }}" method="GET" target="_blank" class="inline-block">
                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-xs font-semibold rounded-xl text-white bg-rose-600 hover:bg-rose-700 shadow-sm hover:shadow-md transition-all">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h10a2 2 0 012 2v14l-5-3-5 3-5-3V5a2 2 0 012-2z" />
                    </svg>
                    Export PDF
                </button>
            </form>
        </div>
    </div>
</div>
