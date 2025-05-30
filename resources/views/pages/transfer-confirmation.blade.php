@extends('layouts.app')

@section('content')

    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-[#316783] mb-6">Payment Transfer</h2>

        <!-- Countdown Timer -->
        <div id="countdown" class="bg-yellow-100 text-yellow-700 p-3 rounded mb-4">
            Time remaining for payment: <span id="timer"></span>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const countdownElement = document.getElementById('timer');
                const deadline = new Date("{{ \Carbon\Carbon::parse($deadline)->format('Y-m-d H:i:s') }}").getTime();

                const interval = setInterval(function () {
                    const now = new Date().getTime();
                    const distance = deadline - now;

                    if (distance < 0) {
                        clearInterval(interval);
                        countdownElement.innerHTML = "Payment time has expired.";
                        countdownElement.closest('#countdown').classList.replace('bg-yellow-100', 'bg-red-100');
                        countdownElement.closest('#countdown').classList.replace('text-yellow-700', 'text-red-700');
                        return;
                    }

                    const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                    const minutes = Math.floor((distance / (1000 * 60)) % 60);
                    const seconds = Math.floor((distance / 1000) % 60);

                    countdownElement.innerHTML = `${hours}h ${minutes}m ${seconds}s`;
                }, 1000);
            });
        </script>

        <!-- Payment Form -->

        @if(session('success'))
            <div class="bg-green-100 p-3 rounded mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <p class="font-medium text-lg">Booking ID: <strong>{{ $booking->id }}</strong></p>
            <p class="font-medium text-lg">Price: <strong>Rp{{ number_format($booking->booking_price, 0, ',', '.') }}</strong></p>
        </div>

        <form action="{{ route('transfer.submit', $booking->id) }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-6">
            @csrf

            <!-- Bank Selection -->
            <div class="mb-4">
                <label for="transfer_to" class="block font-medium text-gray-700">Transfer to</label>
                <select name="transfer_to" id="transfer_to" required class="w-full border-gray-300 p-3 rounded-md focus:ring-[#316783] focus:border-[#316783]">
                    <option value="">-- Select Bank --</option>
                    <option value="BCA">BCA - 1234567890</option>
                    <option value="BNI">BNI - 9876543210</option>
                    <option value="Mandiri">Mandiri - 5432109876</option>
                </select>
            </div>

            <!-- Upload Proof -->
            <div class="mb-4">
                <label for="proof" class="block font-medium text-gray-700">Upload Transfer Proof</label>
                <input type="file" name="proof" id="proof" required class="w-full border-gray-300 p-3 rounded-md focus:ring-[#316783] focus:border-[#316783]">
                @error('proof')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="btn btn-warning py-3 px-6 rounded-md font-semibold text-white">
                    Confirm Transfer
                </button>
            </div>
        </form>

        <!-- Back Link -->
        <div class="text-center mt-6">
            <a href="{{ route('user.history') }}" class="inline-block text-indigo-600 hover:text-indigo-800 border border-indigo-500 px-5 py-2 rounded-lg font-medium transition">⬅️ Back</a>
        </div>
    </div>
@endsection
