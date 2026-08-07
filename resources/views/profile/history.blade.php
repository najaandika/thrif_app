<x-profile.standalone-layout title="Riwayat Pembelian" breadcrumb="Riwayat">
    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl">
        <livewire:profile.order-history />
        @livewire('orders.customer-receipt-modal')
    </section>
</x-profile.standalone-layout>

