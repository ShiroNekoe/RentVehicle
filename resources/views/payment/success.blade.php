@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-green-100 rounded shadow text-center">
    <h1 class="text-3xl font-bold mb-4 text-green-700">Pembayaran Berhasil!</h1>
    <p>Terima kasih, pembayaran untuk booking ID <strong>{{ $payment->booking->id }}</strong> telah diterima.</p>

   <a href="{{ route('user.booking_detail', $payment->booking->id) }}" 
    class="mt-6 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">
    Kembali ke Detail Booking
</a>
</div>
@endsection
