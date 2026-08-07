<div class="dashboard-container">
    <div class="dashboard-layout">
        <x-sidebar />
        
        <div class="dashboard-content-wrapper">
            <div class="dashboard-content">
                <div class="dashboard-grid-gap">
                    @include('livewire.dashboard.stats')

                    <div class="bottom-grid">
                        @include('livewire.dashboard.recent-products')
                        @include('livewire.dashboard.quick-actions')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

