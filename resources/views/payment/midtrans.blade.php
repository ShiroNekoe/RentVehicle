<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midtrans Payment</title>
</head>
<body>
    <button id="pay-button">Bayar dengan Midtrans</button>

    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay("{{ $snapToken }}", {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    window.location.href = "{{ route('payment.callback') }}?result=" + JSON.stringify(result);
                },
                onPending: function(result) {
                    alert("Pembayaran tertunda.");
                },
                onError: function(result) {
                    alert("Pembayaran gagal.");
                }
            });
        };
    </script>
</body>
</html>
