<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Midtrans Sandbox Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>
</head>
<body>
    <button id="pay-button">Bayar (Sandbox)</button>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay(@json($snapToken), {
                onSuccess: function (result) {
                    console.log('success', result);
                    alert('Pembayaran sandbox berhasil, cek console log.');
                },
                onPending: function (result) {
                    console.log('pending', result);
                },
                onError: function (result) {
                    console.error('error', result);
                    alert('Terjadi error, cek console log.');
                },
                onClose: function () {
                    console.log('customer closed the popup');
                }
            });
        });
    </script>
</body>
</html>
