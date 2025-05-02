<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Midtrans</title>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    <h2>Mohon tunggu, memproses pembayaran...</h2>

    <script type="text/javascript">
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                console.log(result);
                window.location.href = '/'; // redirect setelah sukses
            },
            onPending: function(result) {
                alert("Menunggu pembayaran Anda.");
                console.log(result);
                window.location.href = '/';
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
                console.log(result);
                window.location.href = '/';
            }
        });
    </script>
</body>
</html>
