@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <!-- Filter Section -->
    <form method="GET" action="{{ route('user.history') }}" class="bg-white p-6 rounded-xl shadow-md border mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">🔍 Filter Riwayat Booking</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filter Booking Status -->
            <div>
                <label for="booking_status" class="block text-sm font-medium text-gray-700 mb-1">Status Booking</label>
                <select name="booking_status" id="booking_status" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('booking_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('booking_status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('booking_status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <!-- Filter Payment Status -->
            <div>
                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                <select name="payment_status" id="payment_status" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">Semua</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                    <option value="expired" {{ request('payment_status') == 'expired' ? 'selected' : '' }}>Kadaluarsa</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition w-full">Filter</button>
            </div>
        </div>
    </form>

    <!-- Riwayat Booking -->
    <div>
        <h2 class="text-2xl font-bold mb-4 text-primary">📖 Riwayat Booking Anda</h2>
        @if ($bookings->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($bookings as $booking)
                    <div class="bg-white shadow-md rounded-xl p-5 border hover:shadow-lg transition duration-300">
                        <div class="flex items-start">
                            <div class="text-3xl mr-3">🚗</div>
                            <div class="flex-grow">
                                <h3 class="text-lg font-semibold text-gray-700">{{ $booking->vehicle->vehicle_name }}</h3>

                                <p class="text-sm text-gray-500">
                                    Status Booking:
                                    <span class="capitalize font-medium text-blue-600">{{ $booking->booking_status }}</span>
                                </p>

                                <p class="text-sm text-gray-400 mb-1">Tanggal Booking: {{ $booking->created_at->format('d M Y') }}</p>

                                <p class="text-sm">
                                    Status Pembayaran:
                                    @if ($booking->payment_status === 'paid')
                                        <span class="text-green-600 font-semibold">LUNAS</span>
                                    @elseif ($booking->payment_status === 'pending')
                                        <span class="text-yellow-600 font-semibold">MENUNGGU</span>
                                    @elseif ($booking->payment_status === 'failed')
                                        <span class="text-red-500 font-semibold">GAGAL</span>
                                    @elseif ($booking->payment_status === 'expired')
                                        <span class="text-red-400 font-semibold">KADALUARSA</span>
                                    @endif
                                </p>

                                <a href="{{ route('user.booking_detail', $booking->id) }}" class="inline-block mt-3 text-sm text-blue-500 hover:underline font-medium">🔍 Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 mt-8">🔎 Tidak ditemukan hasil yang sesuai dengan filter.</div>
        @endif
    </div>
</div>
@endsection
