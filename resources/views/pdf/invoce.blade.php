<!DOCTYPE html>
<html>
<head>
    <title>Invoice Booking</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { text-align: left; padding: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h2>Invoice Booking</h2>
    <p><strong>Nama Pelanggan:</strong> {{ $booking->user->name }}</p>
    <p><strong>Nama Kendaraan:</strong> {{ $booking->vehicle->vehicle_name }}</p>
    <p><strong>Tanggal:</strong> {{ $booking->start_date }} s/d {{ $booking->end_date }}</p>
    <p><strong>Total Harga:</strong> Rp{{ number_format($booking->booking_price, 0, ',', '.') }}</p>

    <p><em>Terima kasih telah menggunakan layanan kami.</em></p>
</body>
</html>
