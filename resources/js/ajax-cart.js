/**
 * AJAX Cart - Add to cart without page refresh
 */
document.addEventListener('DOMContentLoaded', function () {
    // Handle all cart forms
    document.querySelectorAll('form[action*="landing/cart"]').forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const button = form.querySelector('button[type="submit"]');
            const originalContent = button.innerHTML;

            // Show loading state
            button.disabled = true;
            button.innerHTML = `
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: new FormData(form)
                });

                const data = await response.json();

                if (data.success) {
                    // Update cart counter
                    updateCartCounter(data.cart_count);

                    // Show success feedback
                    showToast(data.message, 'success');

                    // Brief success animation on button
                    button.innerHTML = `
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    `;

                    setTimeout(() => {
                        button.innerHTML = originalContent;
                        button.disabled = false;
                    }, 1000);
                } else {
                    showToast(data.message || 'Gagal menambahkan ke keranjang', 'error');
                    button.innerHTML = originalContent;
                    button.disabled = false;
                }
            } catch (error) {
                console.error('Cart error:', error);
                showToast('Terjadi kesalahan', 'error');
                button.innerHTML = originalContent;
                button.disabled = false;
            }
        });
    });
});

function updateCartCounter(count) {
    // Update all cart counters on the page
    document.querySelectorAll('[data-cart-count]').forEach(el => {
        el.textContent = count;
        el.classList.remove('hidden');
    });

    // Also update cart badge if exists
    const badge = document.querySelector('.cart-badge');
    if (badge) {
        badge.textContent = count;
        badge.classList.remove('hidden');
    }
}

function showToast(message, type = 'success') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 left-1/2 -translate-x-1/2 px-4 py-2.5 rounded-xl text-sm font-medium shadow-lg z-50 transition-all duration-300 transform translate-y-2 opacity-0 ${type === 'success'
            ? 'bg-emerald-600 text-white'
            : 'bg-red-600 text-white'
        }`;
    toast.textContent = message;
    document.body.appendChild(toast);

    // Animate in
    requestAnimationFrame(() => {
        toast.classList.remove('translate-y-2', 'opacity-0');
    });

    // Remove after delay
    setTimeout(() => {
        toast.classList.add('translate-y-2', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 2500);
}
