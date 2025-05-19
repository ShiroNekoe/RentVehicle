<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { border: 1px solid #ccc; padding: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>INVOICE BOOKING</h2>
    </div>

    <div class="details">
        <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
        <p><strong>Nama:</strong> {{ $booking->user->name }}</p>
        <p><strong>Kendaraan:</strong> {{ $booking->vehicle->name }}</p>
        <p><strong>Tanggal:</strong> {{ $booking->booking_date->format('d M Y') }}</p>
        <p><strong>Durasi:</strong> {{ $booking->start_date }} s.d {{ $booking->end_date }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($booking->booking_price, 0, ',', '.') }}</p>
        <p><strong>Metode Pembayaran:</strong> COD</p>
    </div>
</body>
</html>
