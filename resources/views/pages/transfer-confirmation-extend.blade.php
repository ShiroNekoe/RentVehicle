@extends('layouts.app')
@section('title', 'Booking Extension Payment Confirmation')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg space-y-6">
    <h1 class="text-2xl font-bold text-[#316783] text-center mb-4">Payment Confirmation</h1>

    <div class="space-y-2 text-gray-800">
        <p><strong>Booking ID:</strong> {{ $payment->booking->id }}</p>
        <p><strong>Vehicle Name:</strong> {{ $payment->booking->vehicle->vehicle_name ?? '-' }}</p>
        <p><strong>New Booking End Date:</strong> {{ \Carbon\Carbon::parse($payment->booking->end_date)->format('d M Y') }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
        <p><strong>Amount Due:</strong> Rp {{ number_format($payment->payment_price, 0, ',', '.') }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($payment->payment_status) }}</p>
    </div>

    @if($payment->payment_status === 'pending')
        <form action="{{ route('payment.process', ['payment' => $payment->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-6">
            @csrf

            <label for="proof" class="block font-medium text-gray-700">Upload Payment Proof (photo):</label>
            <input type="file" name="proof" id="proof" accept="image/*" required class="input input-bordered w-full rounded-md focus:ring-[#316783] focus:border-[#316783]">

            <button type="submit" class="btn btn-warning w-full py-3 text-white font-semibold hover:scale-105 transition-transform duration-200">
                Pay Now
            </button>
        </form>
    @else
        <p class="mt-6 text-green-600 font-semibold text-center">Payment has been processed.</p>
        @if($payment->proof)
            <div class="mt-4 text-center">
                <strong>Payment Proof:</strong><br>
                <img src="{{ asset('storage/' . $payment->proof) }}" alt="Payment Proof" class="mx-auto max-w-full h-auto rounded shadow mt-2" />
            </div>
        @endif
    @endif

    <div class="mt-6 text-center">
        <a href="{{ route('user.booking_detail', $payment->booking->id) }}" class="inline-block text-indigo-600 hover:text-indigo-800 border border-indigo-500 px-5 py-2 rounded-lg font-medium transition">
            ⬅️ Back to Booking Details
        </a>
    </div>
</div>
@endsection
