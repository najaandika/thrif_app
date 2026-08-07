<div wire:poll.5s>
    @include('components.sidebar.menu', ['pendingOrdersCount' => $this->pendingOrdersCount, 'mobile' => $mobile ?? false])
</div>

