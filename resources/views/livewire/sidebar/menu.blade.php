<div wire:poll.5s>
    @include('components.sidebar.menu', [
        'pendingOrdersCount' => $this->pendingOrdersCount,
        'readyProductsCount' => $this->readyProductsCount,
        'mobile' => $mobile ?? false,
    ])
</div>

