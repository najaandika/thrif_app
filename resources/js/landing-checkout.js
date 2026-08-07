import { showCheckoutSuccessAlert } from './checkout-alerts';

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('checkout-form');
    const submitBtn = document.getElementById('submit-order-btn');
    const paymentSelect = form?.querySelector('select[name="payment_method"]');

    if (!form || !submitBtn || !paymentSelect) {
        return;
    }

    const setLoading = (isLoading) => {
        submitBtn.disabled = isLoading;
    };

    const loadMidtransSnap = () => new Promise((resolve, reject) => {
        if (window.snap) {
            resolve(window.snap);
            return;
        }

        const clientKey = document.querySelector('meta[name="midtrans-client-key"]')?.content;
        if (!clientKey) {
            reject(new Error('Client key Midtrans tidak ditemukan.'));
            return;
        }

        const existingScript = document.querySelector('script[data-midtrans-snap="true"]');
        if (existingScript) {
            existingScript.addEventListener('load', () => resolve(window.snap), { once: true });
            existingScript.addEventListener('error', () => reject(new Error('Gagal memuat Midtrans Snap.')), { once: true });
            return;
        }

        const script = document.createElement('script');
        script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
        script.async = true;
        script.dataset.midtransSnap = 'true';
        script.dataset.clientKey = clientKey;
        script.onload = () => {
            if (window.snap) {
                resolve(window.snap);
                return;
            }

            reject(new Error('Midtrans Snap belum siap.'));
        };
        script.onerror = () => reject(new Error('Gagal memuat Midtrans Snap.'));
        document.head.appendChild(script);
    });

    form.addEventListener('submit', async function (e) {
        const method = paymentSelect.value;
        setLoading(true);

        if (method !== 'midtrans') {
            // Intercept Cash/Pickup to show alert before redirecting
            e.preventDefault();

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: new FormData(form)
            })
                .then(response => response.json().then(data => ({ status: response.status, body: data })))
                .then(({ status, body }) => {
                    if (status === 200 && body.status === 'success') {
                        // Green Success Alert
                        showCheckoutSuccessAlert(
                            body.message || 'Pesanan berhasil dibuat!',
                            body.redirect_url
                        );
                    } else {
                        // Validation or other error
                        console.error('Checkout error:', body);
                        const errorMsg = body.message || 'Terjadi kesalahan, silakan coba lagi.';

                        setLoading(false);

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errorMsg,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'OK',
                            width: '260px',
                            padding: '1rem',
                            customClass: {
                                popup: 'rounded-2xl swal-mobile-compact',
                                confirmButton: 'rounded-lg px-4 py-1.5 text-xs font-semibold',
                                title: 'text-sm font-bold',
                                htmlContainer: 'text-xs'
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    setLoading(false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan jaringan.',
                        confirmButtonText: 'OK'
                    });
                });

            return;
        }

        e.preventDefault();

        // Get snap token from meta tag
        const snapToken = document.querySelector('meta[name="midtrans-snap-token"]')?.content;
        if (!snapToken) {
            Swal.fire({
                icon: 'error',
                text: 'Token pembayaran tidak ditemukan',
                confirmButtonText: 'OK'
            });
            setLoading(false);
            return;
        }

        try {
            await loadMidtransSnap();
        } catch (error) {
            console.error('Midtrans load error:', error);
            Swal.fire({
                icon: 'error',
                text: error.message || 'Sistem pembayaran belum siap. Silakan coba lagi.',
                confirmButtonText: 'OK'
            });
            setLoading(false);
            return;
        }

        window.snap.pay(snapToken, {
            onSuccess: function (result) {
                console.log('Midtrans success', result);

                Swal.fire({
                    title: 'Pembayaran Berhasil!',
                    text: 'Pesanan Anda sedang diproses.',
                    imageUrl: '/images/success-icon.svg',
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
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'suppress_alert';
                    input.value = '1';
                    form.appendChild(input);

                    form.submit();
                });
            },
            onPending: function (result) {
                console.log('Midtrans pending', result);
                setLoading(false);

                // DO NOT submit form - payment is not complete yet
                // Just show info message and let user retry or wait
                Swal.fire({
                    title: 'Menunggu Pembayaran',
                    text: 'Pembayaran belum selesai. Silakan selesaikan pembayaran untuk melanjutkan pesanan.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3b82f6',
                    width: '280px',
                    padding: '1rem',
                    customClass: {
                        popup: 'rounded-2xl swal-mobile-compact',
                        confirmButton: 'rounded-lg px-4 py-1.5 text-xs font-semibold',
                        title: 'text-sm font-bold',
                        htmlContainer: 'text-xs'
                    }
                });
                // Form NOT submitted - order will NOT be created
            },
            onError: function (result) {
                console.error('Midtrans error', result);
                setLoading(false);
                Swal.fire({
                    icon: 'error',
                    title: 'Pembayaran Gagal',
                    text: 'Silakan coba lagi.',
                    confirmButtonText: 'OK'
                });
            },
            onClose: function () {
                console.log('Midtrans popup closed without completing payment');
                setLoading(false);

                // Show message that payment was cancelled
                Swal.fire({
                    title: 'Pembayaran Dibatalkan',
                    text: 'Anda menutup halaman pembayaran. Pesanan tidak dibuat.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f59e0b',
                    width: '280px',
                    padding: '1rem',
                    customClass: {
                        popup: 'rounded-2xl swal-mobile-compact',
                        confirmButton: 'rounded-lg px-4 py-1.5 text-xs font-semibold',
                        title: 'text-sm font-bold',
                        htmlContainer: 'text-xs'
                    }
                });
            }
        });
    });
});
