@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Invoice Booking</h1>

    <div class="bg-white shadow p-6 rounded-lg border">
        <p><strong>Nama Kendaraan:</strong> {{ $booking->vehicle->vehicle_name }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($booking->vehicle->price, 0, ',', '.') }}</p>
        <p><strong>Status Pembayaran:</strong> {{ strtoupper($booking->payment_status) }}</p>
        <p><strong>Tanggal Booking:</strong> {{ $booking->created_at->format('d M Y H:i') }}</p>
        <p><strong>Titik Jemput:</strong> {{ $booking->pickup_location ?? '-' }}</p>

        <hr class="my-4">

        <p><strong>Nama User:</strong> {{ $booking->user->name }}</p>
        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
    </div>

    <a href="{{ route('user.history') }}" class="mt-4 inline-block text-indigo-600 hover:underline">⬅️ Kembali</a>
</div>
@endsection
