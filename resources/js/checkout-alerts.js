// Checkout Success Alert Handler
export function showCheckoutSuccessAlert(message, redirectUrl) {
    // Inject custom styles for compact alerts if not exists
    if (!document.getElementById('swal-custom-style')) {
        const style = document.createElement('style');
        style.id = 'swal-custom-style';
        style.innerHTML = `
            div.swal2-popup.swal-mobile-compact {
                width: 260px !important;
                padding: 1rem !important;
            }
            div.swal2-popup.swal-mobile-compact .swal2-title {
                font-size: 14px !important;
            }
            div.swal2-popup.swal-mobile-compact .swal2-html-container {
                font-size: 12px !important;
            }
        `;
        document.head.appendChild(style);
    }

    // Prevent multiple alerts if one is already open
    if (Swal.isVisible()) {
        return;
    }

    Swal.fire({
        title: 'Sukses!',
        text: message,
        imageUrl: '/images/success-icon.svg',
        imageWidth: 40,
        imageHeight: 40,
        imageAlt: 'Success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#10b981', // emerald-500
        allowOutsideClick: false, // Force user to click OK
        allowEscapeKey: false,
        width: '260px',
        padding: '1rem',
        customClass: {
            popup: 'rounded-2xl swal-mobile-compact',
            confirmButton: 'rounded-lg px-4 py-1.5 text-xs font-semibold',
            image: 'mb-2',
            title: 'text-sm font-bold',
            htmlContainer: 'text-xs'
        }
    }).then((result) => {
        // Only redirect on explicit confirmation (clicking OK)
        if (result.isConfirmed) {
            window.location.href = redirectUrl;
        }
    });
}

// Auto-trigger on page load if session status exists
export function initCheckoutAlerts() {
    const statusMessage = document.querySelector('[data-checkout-status]')?.dataset.checkoutStatus;
    const redirectUrl = document.querySelector('[data-checkout-redirect]')?.dataset.checkoutRedirect;

    if (statusMessage && redirectUrl) {
        showCheckoutSuccessAlert(statusMessage, redirectUrl);
    }
}
