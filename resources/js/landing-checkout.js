// resources/js/landing-checkout.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('checkout-form');
    const submitBtn = document.getElementById('submit-order-btn');
    const paymentSelect = form?.querySelector('select[name="payment_method"]');
    const submitIcon = submitBtn?.querySelector('.submit-icon');
    const loadingSpinner = submitBtn?.querySelector('.loading-spinner');
    const submitText = submitBtn?.querySelector('.submit-text');

    if (!form || !submitBtn || !paymentSelect || !window.snap) {
        return;
    }

    const resetButton = () => {
        submitBtn.disabled = false;
        if (submitIcon) submitIcon.classList.remove('hidden');
        if (loadingSpinner) loadingSpinner.classList.add('hidden');
        if (submitText) submitText.textContent = 'Kirim Order';
    };

    form.addEventListener('submit', function (e) {
        const method = paymentSelect.value;

        if (method !== 'midtrans') {
            return; // submit normal for cash/transfer
        }

        e.preventDefault();

        // Optional: disable button while processing
        submitBtn.disabled = true;

        window.snap.pay(window.snapToken, {
            onSuccess: function (result) {
                console.log('Midtrans success', result);
                resetButton();
                form.submit();
            },
            onPending: function (result) {
                console.log('Midtrans pending', result);
                resetButton();
            },
            onError: function (result) {
                console.error('Midtrans error', result);
                alert('Pembayaran gagal, silakan coba lagi.');
                resetButton();
            },
            onClose: function () {
                console.log('Midtrans popup closed');
                resetButton();
            }
        });
    });
});
