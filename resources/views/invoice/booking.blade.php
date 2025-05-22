@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Invoice Booking</h1>

    <div class="bg-white shadow p-6 rounded-lg border space-y-2">
        <p>Booking id :{{$booking->id}}</p>
        
        <hr class="my-4">

        <h2 class="text-lg font-semibold">Informasi User</h2>
        <p><strong>Nama:</strong> {{ $booking->user->name }}</p>
        <p><strong>Email:</strong> {{ $booking->user->email }}</p>


         <hr class="my-4">
        
         <p><strong>Nama Kendaraan:</strong> {{ $booking->vehicle->vehicle_name }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
        <p><strong>Total Harga Booking:</strong> Rp {{ number_format($booking->booking_price, 0, ',', '.') }}</p>
        <p><strong>Titik Jemput:</strong> {{ $booking->pickup_location ?? '-' }}</p>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <a href="{{ route('user.history') }}" class="text-indigo-600 hover:underline">⬅️ Kembali</a>
       <a href="{{ route('booking.invoice', $booking->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Download PDF</a>
a
    </div>
</div>
@endsection
