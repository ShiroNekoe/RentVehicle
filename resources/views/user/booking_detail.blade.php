<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-primary mb-6">Detail Booking</h2>

    <div class="bg-white shadow-md rounded-xl p-6 mb-6">
        <h3 class="text-2xl font-semibold text-gray-700">{{ $booking->vehicle->vehicle_name }}</h3>
        <p class="text-lg text-gray-600">Tipe Kendaraan: {{ ucfirst($booking->vehicle->vehicle_type) }}</p>
        <p class="text-lg text-gray-600">Model: {{ ucfirst($booking->vehicle->vehicle_model) }}</p>
        <p class="text-lg text-gray-600">Transmisi: {{ ucfirst($booking->vehicle->vehicle_transmission) }}</p>
        <p class="text-lg text-gray-600">Nomor Plat: {{ $booking->vehicle->number_plate }}</p>

        <h4 class="text-xl font-semibold mt-4">Status Booking</h4>
        <p class="text-lg text-gray-500">{{ ucfirst($booking->booking_status) }}</p>

        <h4 class="text-xl font-semibold mt-4">Status Pembayaran</h4>
        <p class="text-lg text-gray-500">
            @if ($booking->payment_status == 'paid')
                <span class="text-green-600 font-bold">LUNAS</span>
            @elseif ($booking->payment_status == 'pending')
                <span class="text-yellow-500 font-bold">MENUNGGU PEMBAYARAN</span>
            @elseif ($booking->payment_status == 'failed' || $booking->payment_status == 'expired')
                <span class="text-red-500 font-bold">GAGAL / KADALUARSA</span>
            @else
                <span class="text-gray-500">Status tidak diketahui</span>
            @endif
        </p>

        <h4 class="text-xl font-semibold mt-4">Tanggal Booking</h4>
        <p class="text-lg text-gray-500">{{ $booking->created_at->format('d M Y H:i') }}</p>

        <h4 class="text-xl font-semibold mt-4">Total Pembayaran</h4>
        <p class="text-lg text-gray-500">Rp {{ number_format($booking->vehicle->price, 0, ',', '.') }}</p>

        <a href="{{ route('user.dashboard') }}" class="btn btn-outline mt-4">Kembali ke Dashboard</a>
    </div>
</div>
