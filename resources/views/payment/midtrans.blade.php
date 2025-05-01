{{-- resources/views/payment/midtrans.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proses Pembayaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Silakan Selesaikan Pembayaran</h1>

    <button id="pay-button">Bayar Sekarang</button>

    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil!');
                    window.location.href = '/dashboard'; // arahkan ke halaman sukses
                },
                onPending: function(result) {
                    alert('Menunggu pembayaran...');
                    window.location.href = '/dashboard';
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                    console.log(result);
                    window.location.href = '/dashboard';
                },
                onClose: function() {
                    alert('Kamu menutup popup pembayaran.');
                }
            });
        });
    </script>
</body>
</html>
