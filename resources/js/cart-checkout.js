import Swal from 'sweetalert2';

/**
 * Cart Checkout Logic
 * Handles Midtrans payments and Success Alerts
 */

document.addEventListener('livewire:initialized', () => {

    // Inject custom styles for compact alerts
    const style = document.createElement('style');
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

    // 1. Handle Midtrans Payment Trigger
    Livewire.on('open-midtrans-payment', (event) => {
        const token = event.token;

        // Ensure Snap is loaded
        if (typeof window.snap === 'undefined') {
            Swal.fire({
                icon: 'error',
                text: 'Sistem pembayaran belum siap (Snap.js not loaded). Silakan refresh.',
                confirmButtonText: 'OK'
            });
            return;
        }

        window.snap.pay(token, {
            onSuccess: function (result) {
                console.log('Payment Success', result);
                document.getElementById('payment-result-input').value = JSON.stringify(result);

                // Show success alert first
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Pesanan berhasil dibuat!',
                    imageUrl: window.location.origin + "/images/success-icon.svg",
                    imageWidth: 40,
                    imageHeight: 40,
                    imageAlt: 'Success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#10b981',
                    width: '260px',
                    padding: '1rem',
                    customClass: {
                        popup: 'rounded-2xl swal-mobile-compact',
                        confirmButton: 'rounded-lg px-4 py-1.5 text-xs font-semibold',
                        image: 'mb-2',
                        title: 'text-sm font-bold',
                        htmlContainer: 'text-xs'
                    }
                }).then(() => {
                    // Signal backend to suppress session alert
                    const form = document.getElementById('finalize-form');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'suppress_alert';
                    input.value = '1';
                    form.appendChild(input);

                    // Submit form after user clicks OK
                    form.submit();
                });
            },
            onPending: function (result) {
                console.log('Payment Pending', result);
                document.getElementById('payment-result-input').value = JSON.stringify(result);

                // Show pending alert
                Swal.fire({
                    title: 'Menunggu',
                    text: 'Pembayaran sedang diproses.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3b82f6',
                    width: '260px',
                    padding: '1rem',
                    customClass: {
                        popup: 'rounded-2xl swal-mobile-compact',
                        confirmButton: 'rounded-lg px-4 py-1.5 text-xs font-semibold',
                        title: 'text-sm font-bold',
                        htmlContainer: 'text-xs'
                    }
                }).then(() => {
                    document.getElementById('finalize-form').submit();
                });
            },
            onError: function (result) {
                console.error('Payment Error', result);
                Swal.fire({
                    icon: 'error',
                    title: 'Pembayaran Gagal',
                    text: 'Silakan coba lagi.',
                    confirmButtonText: 'OK'
                });
            },
            onClose: function () {
                console.log('Payment popup closed. No order created.');
            }
        });
    });

    // 2. Handle Cart Success Alert
    Livewire.on('show-cart-success', (event) => {
        console.log('Cart Success Event Received', event);

        Swal.fire({
            title: 'Sukses!',
            text: event.message,
            imageUrl: window.location.origin + "/images/success-icon.svg",
            imageWidth: 40,
            imageHeight: 40,
            imageAlt: 'Success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#10b981',
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
            if (result.isConfirmed || result.isDismissed) {
                // Redirect logic
                // Check if event has redirect url, otherwise default to history
                window.location.href = "/landing/orders/history";
            }
        });
    });
});
