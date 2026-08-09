<x-profile.standalone-layout title="Riwayat Pembelian" breadcrumb="Riwayat">
    <section class="profile-panel">
        <livewire:profile.order-history />
        @livewire('orders.customer-receipt-modal')
    </section>
</x-profile.standalone-layout>

