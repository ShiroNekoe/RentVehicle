@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow p-6 rounded mt-10">
    <h2 class="text-xl font-semibold mb-4">Invoice COD</h2>

    <div class="border rounded p-4 mb-4">
        <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
        <p><strong>Nama:</strong> {{ $booking->user->name }}</p>
        <p><strong>Kendaraan:</strong> {{ $booking->vehicle->name }}</p>
        <p><strong>Tanggal Booking:</strong> {{ $booking->booking_date->format('d M Y') }}</p>
        <p><strong>Durasi:</strong> {{ $booking->start_date }} s.d {{ $booking->end_date }}</p>
        <p><strong>Metode Pembayaran:</strong> Bayar di Tempat (COD)</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($booking->booking_price, 0, ',', '.') }}</p>
    </div>

    <a href="{{ route('invoice.booking', $booking->id) }}"
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Download Invoice (PDF)
    </a>
</div>
@endsection
