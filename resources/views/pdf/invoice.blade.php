<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header .left {
            max-width: 70%;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: center;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="left">
            <h2>Invoice Booking Kendaraan</h2>
            <p><strong>Tanggal Booking:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Nama Pengguna:</strong> {{ $booking->user->name ?? '-' }}</p>
        </div>
        <div class="right">
            {{-- Ganti src dengan logo asli --}}
            <img src="{{ public_path('logo.png') }}" alt="Logo" class="logo">
        </div>
    </div>

    <table>
        <tr>
            <th>Mulai Sewa</th>
            <td>{{ $booking->start_date }}</td>
        </tr>
        <tr>
            <th>Selesai Sewa</th>
            <td>{{ $booking->end_date }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp {{ number_format($booking->booking_price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($booking->booking_status) }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih telah menggunakan layanan kami. Jika ada pertanyaan, silakan hubungi customer service kami.</p>
    </div>
</body>
</html>
