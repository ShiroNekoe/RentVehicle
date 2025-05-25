@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow">
  <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow">
    <div id="countdown" class="bg-yellow-100 text-yellow-700 p-3 rounded mb-4">
        Waktu tersisa untuk pembayaran: <span id="timer"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countdownElement = document.getElementById('timer');
            const deadline = new Date("{{ $deadline }}").getTime();

            const interval = setInterval(function () {
                const now = new Date().getTime();
                const distance = deadline - now;

                if (distance < 0) {
                    clearInterval(interval);
                    countdownElement.innerHTML = "Waktu pembayaran telah habis.";
                    countdownElement.closest('#countdown').classList.replace('bg-yellow-100', 'bg-red-100');
                    countdownElement.closest('#countdown').classList.replace('text-yellow-700', 'text-red-700');
                    return;
                }

                const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((distance / (1000 * 60)) % 60);
                const seconds = Math.floor((distance / 1000) % 60);

                countdownElement.innerHTML = `${hours}j ${minutes}m ${seconds}d`;
            }, 1000);
        });
    </script>
</div>


    <h2 class="text-xl font-bold mb-4">Transfer Pembayaran</h2>

    @if(session('success'))
        <div class="bg-green-100 p-3 rounded mb-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <p>Booking ID: <strong>{{ $booking->id }}</strong></p>
    <p>Harga: <strong>Rp{{ number_format($booking->booking_price, 0, ',', '.') }}</strong></p>

    <form action="{{ route('transfer.submit', $booking->id) }}" method="POST" enctype="multipart/form-data" class="mt-5">
        @csrf

        <div class="mb-4">
            <label for="transfer_to" class="block font-medium">Transfer ke</label>
            <select name="transfer_to" id="transfer_to" required class="w-full border p-2 rounded">
                <option value="">-- Pilih Bank --</option>
                <option value="BCA">BCA - 1234567890</option>
                <option value="BNI">BNI - 9876543210</option>
                <option value="Mandiri">Mandiri - 5432109876</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="proof" class="block font-medium">Upload Bukti Transfer</label>
            <input type="file" name="proof" id="proof" required class="w-full border p-2 rounded">
            @error('proof')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
            Konfirmasi Transfer
        </button>
    </form>
      <a href="{{ route('user.history') }}" class="text-indigo-600 hover:underline">⬅️ Kembali</a>
</div>


@endsection
