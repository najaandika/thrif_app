<div wire:key="sidebar-menu-{{ $mobile ? 'mobile' : 'desktop' }}">
    @include('components.sidebar.menu', [
        'pendingOrdersCount' => $this->pendingOrdersCount,
        'readyProductsCount' => $this->readyProductsCount,
        'mobile' => $mobile ?? false,
    ])
</div>

