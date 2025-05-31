@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran Perpanjangan Booking')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Konfirmasi Pembayaran</h1>

    <p><strong>Booking ID:</strong> {{ $payment->booking->id }}</p>
    <p><strong>Nama Kendaraan:</strong> {{ $payment->booking->vehicle->vehicle_name ?? '-' }}</p>
    <p><strong>Tanggal Akhir Booking Baru:</strong> {{ \Carbon\Carbon::parse($payment->booking->end_date)->format('d M Y') }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($payment->payment_method) }}</p>
    <p><strong>Jumlah yang harus dibayar:</strong> Rp {{ number_format($payment->payment_price, 0, ',', '.') }}</p>
    <p><strong>Status Pembayaran:</strong> {{ ucfirst($payment->payment_status) }}</p>

    @if($payment->payment_status === 'pending')
        <form action="{{ route('payment.process', ['payment' => $payment->id]) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            
            <label for="proof" class="block font-medium mb-2">Upload Bukti Pembayaran (foto):</label>
            <input type="file" name="proof" id="proof" accept="image/*" required class="mb-4 w-full">

            <button type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700 transition">
                Bayar Sekarang
            </button>
        </form>
    @else
        <p class="mt-6 text-green-600 font-semibold">Pembayaran sudah diproses.</p>
        @if($payment->proof)
            <p class="mt-4">
                <strong>Bukti Pembayaran:</strong><br>
                <img src="{{ asset('storage/' . $payment->proof) }}" alt="Bukti Pembayaran" class="max-w-full h-auto rounded shadow mt-2" />
            </p>
        @endif
    @endif

   <a href="{{ route('user.booking_detail', $payment->booking->id) }}" 
    class="mt-6 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">
    Kembali ke Detail Booking
</a>

</div>
@endsection
