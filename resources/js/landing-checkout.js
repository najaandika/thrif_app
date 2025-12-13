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


    form.addEventListener('submit', function (e) {
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

        if (!window.snap) {
            Swal.fire({
                icon: 'error',
                text: 'Sistem pembayaran (Snap) belum siap. Silakan refresh halaman.',
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
                Swal.fire({
                    title: 'Menunggu Pembayaran',
                    text: 'Silakan selesaikan pembayaran Anda.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    width: '260px',
                    padding: '1rem',
                    customClass: {
                        popup: 'rounded-2xl swal-mobile-compact',
                        confirmButton: 'rounded-lg px-4 py-1.5 text-xs font-semibold',
                        title: 'text-sm font-bold',
                        htmlContainer: 'text-xs'
                    }
                }).then(() => {
                    form.submit();
                });
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
                console.log('Midtrans popup closed');
                setLoading(false);
            }
        });
    });
});
