<div class="py-12" wire:poll.5s>
    <div>
        @include('livewire.orders._flash')

        <div class="flex flex-row gap-6">
            <x-sidebar />

            <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-8">
                        @include('livewire.orders._filters')



                        @include('livewire.orders._table')
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.orders._modal')
</div>

