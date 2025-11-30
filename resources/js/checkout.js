// JS khusus halaman checkout

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action*="order"]');
    const submitBtn = document.getElementById('submit-order-btn');
    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            const submitIcon = submitBtn.querySelector('.submit-icon');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');
            const submitText = submitBtn.querySelector('.submit-text');
            submitBtn.disabled = true;
            if (submitIcon) submitIcon.classList.add('hidden');
            if (loadingSpinner) loadingSpinner.classList.remove('hidden');
            if (submitText) submitText.textContent = 'Memproses...';
        });
    }
    // Tambahkan JS lain khusus checkout di sini
});
