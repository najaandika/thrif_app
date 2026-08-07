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
    document.querySelectorAll('[data-ajax-cart-toast]').forEach(el => el.remove());

    const toast = document.createElement('div');
    const isSuccess = type === 'success';
    const iconColor = isSuccess ? '#047857' : '#b91c1c';
    const iconBg = isSuccess ? '#ecfdf5' : '#fef2f2';
    const borderColor = isSuccess ? '#d1fae5' : '#fee2e2';
    const icon = isSuccess
        ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" /></svg>'
        : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 8v4m0 4h.01" stroke-linecap="round" /><circle cx="12" cy="12" r="9" /></svg>';

    toast.setAttribute('data-ajax-cart-toast', 'true');
    toast.setAttribute('role', 'status');
    toast.style.cssText = [
        'position: fixed',
        'top: calc(env(safe-area-inset-top, 0px) + 5.25rem)',
        'left: 50%',
        'transform: translate(-50%, -10px)',
        'z-index: 9999',
        'width: min(calc(100vw - 2rem), 25rem)',
        'display: flex',
        'align-items: flex-start',
        'gap: 12px',
        'padding: 12px 14px',
        'border-radius: 18px',
        `border: 1px solid ${borderColor}`,
        'background: rgba(255,255,255,0.98)',
        'box-shadow: 0 24px 70px rgba(15, 23, 42, 0.16)',
        'color: #0f172a',
        'font-size: 14px',
        'line-height: 1.45',
        'opacity: 0',
        'transition: opacity 220ms ease, transform 220ms ease',
        'pointer-events: auto'
    ].join(';');

    toast.innerHTML = `
        <span style="display:flex;height:32px;width:32px;flex-shrink:0;align-items:center;justify-content:center;border-radius:12px;background:${iconBg};color:${iconColor};margin-top:1px;">
            ${icon}
        </span>
        <span style="min-width:0;flex:1;padding-top:4px;font-weight:700;color:#1f2937;">${escapeHtml(message)}</span>
        ${isSuccess ? '<a href="/landing/cart" style="flex-shrink:0;margin-top:1px;border-radius:12px;background:#0f172a;color:#fff;padding:7px 10px;font-size:12px;font-weight:800;text-decoration:none;">Lihat</a>' : ''}
    `;

    document.body.appendChild(toast);

    if (window.matchMedia('(min-width: 768px)').matches) {
        toast.style.left = 'auto';
        toast.style.right = '24px';
        toast.style.transform = 'translateY(-10px)';
    }

    requestAnimationFrame(() => {
        toast.style.opacity = '1';
        toast.style.transform = window.matchMedia('(min-width: 768px)').matches ? 'translateY(0)' : 'translate(-50%, 0)';
    });

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = window.matchMedia('(min-width: 768px)').matches ? 'translateY(-10px)' : 'translate(-50%, -10px)';
        setTimeout(() => toast.remove(), 260);
    }, 2400);
}

function escapeHtml(value) {
    const div = document.createElement('div');
    div.textContent = value;
    return div.innerHTML;
}

