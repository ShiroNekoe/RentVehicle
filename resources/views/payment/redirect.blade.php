<!DOCTYPE html>
<html>
<head>
    <title>Bayar dengan Midtrans</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ $clientKey }}"></script>
</head>
<body>
    <h2>Loading pembayaran...</h2>
    <script type="text/javascript">
        window.onload = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = "/booking/success";
                },
                onPending: function(result){
                    window.location.href = "/booking/pending";
                },
                onError: function(result){
                    window.location.href = "/booking/failed";
                },
                onClose: function(){
                    alert('Kamu menutup popup pembayaran.');
                }
            });
        };
    </script>
</body>
</html>
