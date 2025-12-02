function formatNumber(num) {
    if (!num) return '';
    return num.toString().replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function unformatNumber(str) {
    if (!str) return 0;
    return str.toString().replace(/\./g, '');
}

function setupInput(id) {
    const el = document.getElementById(id);
    if (!el) return;

    el.addEventListener('input', function () {
        const formatted = formatNumber(this.value);
        this.value = formatted;
        const raw = unformatNumber(formatted);

        // Cari komponen Livewire terdekat lalu set property
        const root = this.closest('[wire\\:id]');
        if (!root || !window.Livewire) return;
        const componentId = root.getAttribute('wire:id');
        const component = window.Livewire.find(componentId);
        if (component) {
            component.set(id, raw);
        }
    });
}

function initPosInputs() {
    setupInput('amount_received');
    setupInput('discount');

    if (!window.Livewire) return;

    window.Livewire.on('transaction-completed', () => {
        const amountEl = document.getElementById('amount_received');
        const discountEl = document.getElementById('discount');
        if (amountEl) amountEl.value = '';
        if (discountEl) discountEl.value = '';
    });

    window.Livewire.on('reset-discount', () => {
        const discountEl = document.getElementById('discount');
        if (discountEl) discountEl.value = '';
    });
}

// Inisialisasi untuk first load dan navigasi Livewire
window.addEventListener('DOMContentLoaded', initPosInputs);
window.addEventListener('livewire:load', () => {
    initPosInputs();
    window.Livewire.hook('message.processed', () => {
        initPosInputs();
    });
});
