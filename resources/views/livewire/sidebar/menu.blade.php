<div wire:poll.5s>
    @php
        $pendingOrdersCount = $this->pendingOrdersCount;
    @endphp

    @include('components.sidebar.menu', ['pendingOrdersCount' => $pendingOrdersCount, 'mobile' => $mobile ?? false])
</div>
