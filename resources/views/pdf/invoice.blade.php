<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 40px;
            background-color: #f9fafb;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: 1px solid #e5e7eb;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #6366f1;
            padding-bottom: 15px;
        }

        .header .left h1 {
            font-size: 22px;
            color: #4f46e5;
            margin: 0 0 5px;
        }

        .header .left p {
            margin: 2px 0;
        }

        .logo {
            width: 90px;
            height: auto;
        }

        .section-title {
            font-weight: bold;
            margin: 20px 0 10px;
            font-size: 14px;
            color: #1f2937;
        }

        .info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        .footer {
            margin-top: 40px;
            font-size: 11px;
            text-align: center;
            color: #6b7280;
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="left">
                <h1>Invoice Booking</h1>
                <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
                <p><strong>Tanggal Booking:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
            </div>
            <div class="right">
                <img src="{{ public_path('logo.png') }}" alt="Logo" class="logo">
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Informasi Pengguna</h3>
            <div class="info">
                <p><strong>Nama:</strong> {{ $booking->user->name ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $booking->user->email ?? '-' }}</p>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Detail Booking</h3>
            <div class="info">
                <p><strong>Nama Kendaraan:</strong> {{ $booking->vehicle->vehicle_name ?? '-' }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
                <p><strong>Titik Jemput:</strong> {{ $booking->pickup_location ?? '-' }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($booking->booking_price, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami. Jika ada pertanyaan, silakan hubungi customer service kami.</p>
        </div>
    </div>
</body>
</html>
