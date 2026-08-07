<div class="admin-wrapper">
    <div>
        @if (session()->has('message'))
            <x-alert :message="session('message')" type="success" />
        @endif

        <div class="admin-layout">
            <x-sidebar />

            <!-- Main Content -->
            <div class="admin-content">
                <div class="admin-card">
                    <div class="admin-card-body">
                        @include('livewire.products._filters')
                        @include('livewire.products._table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
