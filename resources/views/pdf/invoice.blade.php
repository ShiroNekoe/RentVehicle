<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            background-color: #f3f4f6;
            color: #111827;
            margin: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #4f46e5;
            margin: 0;
        }

        .logo {
            width: 90px;
            height: auto;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #1f2937;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 5px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 40px;
        }

        .info p {
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
        }

        tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
            color: #dc2626;
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
        <div>
            <h1>Invoice Booking</h1>
            <p><strong>ID Booking:</strong> {{ $booking->id }}</p>
            <p><strong>Tanggal Booking:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
        </div>
        <div>
            <img src="{{ public_path('logo.png') }}" alt="Logo" class="logo">
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informasi Pengguna</div>
        <div class="info">
            <p><strong>Nama:</strong> {{ $booking->user->name ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $booking->user->email ?? '-' }}</p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Detail Booking</div>
        <div class="info-grid">
            <div class="info">
                <p><strong>Nama Kendaraan:</strong> {{ $booking->vehicle->vehicle_name ?? '-' }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
                <p><strong>Jam Pengambilan:</strong> {{ $booking->start_time ?? '-' }}</p>
                <p><strong>Durasi:</strong> {{ $booking->duration_days }} hari</p>
            </div>
            <div class="info">
                <p><strong>Lokasi Jemput:</strong> {{ $booking->pickup_location ?? '-' }}</p>
                <p><strong>Lokasi Pengembalian:</strong>
                    @if($booking->return_locations === 'showroom') Showroom
                    @elseif($booking->return_locations === 'other') {{ $booking->return_location ?? '-' }}
                    @else -
                    @endif
                </p>
                <p><strong>Driver:</strong> {{ $booking->use_driver ? 'Ya (+Rp125.000)' : 'Tidak' }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ strtoupper($booking->payment_method ?? '-') }}</p>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Rincian Harga</div>
        <table>
            <tr>
                <th>Deskripsi</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Harga per Hari</td>
                <td>Rp{{ number_format($booking->vehicle->price ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Durasi ({{ $booking->duration_days }} hari)</td>
                <td>Rp{{ number_format(($booking->vehicle->price ?? 0) * $booking->duration_days, 0, ',', '.') }}</td>
            </tr>
            @if($booking->use_driver)
                <tr>
                    <td>Driver</td>
                    <td>Rp125.000</td>
                </tr>
            @endif
            <tr class="total">
                <td>Total Harga</td>
                <td>Rp{{ number_format($booking->booking_price, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Terima kasih telah menggunakan layanan kami.<br>Jika ada pertanyaan, silakan hubungi customer service kami.</p>
    </div>
</div>
</body>
</html>
