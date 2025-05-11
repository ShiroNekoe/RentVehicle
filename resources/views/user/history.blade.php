@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <!-- Riwayat Pemesanan -->
    <div>
        <h2 class="text-2xl font-bold mb-4 text-primary">Riwayat Pemesanan</h2>
        <div class="overflow-x-auto">
            <div class="flex gap-4 w-max">
                @forelse ($bookings as $booking)
                    <div class="min-w-[280px] bg-white shadow-md rounded-xl p-5 border hover:shadow-xl transition duration-300">
                        <div class="flex items-center mb-3">
                            <div class="text-3xl mr-3">🚗</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">{{ $booking->vehicle->name }}</h3>
                                <p class="text-sm text-gray-500">Status: 
                                    <span class="font-medium capitalize">{{ $booking->status }}</span>
                                </p>
                                <p class="text-sm text-gray-400">Tanggal: {{ $booking->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada pemesanan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Riwayat Booking -->
    <div>
        <h2 class="text-2xl font-bold mb-4 text-primary">Riwayat Booking</h2>
        <div class="overflow-x-auto">
            <div class="flex gap-4 w-max">
                @forelse ($bookings as $booking)
                    <div class="min-w-[300px] bg-white shadow-md rounded-xl p-5 border hover:shadow-xl transition duration-300">
                        <div class="flex items-start">
                            <div class="text-3xl mr-3">🚗</div>
                            <div class="flex-grow">
                                <h3 class="text-lg font-semibold text-gray-700">{{ $booking->vehicle->vehicle_name }}</h3>
                                <p class="text-sm text-gray-500">Status Booking: 
                                    <span class="capitalize font-medium">{{ $booking->booking_status }}</span>
                                </p>
                                <p class="text-sm text-gray-400 mb-2">Tanggal: {{ $booking->created_at->format('d M Y') }}</p>
    
                                <p class="text-sm">
                                    Status Pembayaran:
                                    @if ($booking->payment_status == 'paid')
                                        <span class="text-green-600 font-bold">LUNAS</span>
                                    @elseif ($booking->payment_status == 'pending')
                                        <span class="text-yellow-500 font-bold">MENUNGGU KONFIRMASI ADMIN</span>
                                    @elseif ($booking->payment_status == 'failed' || $booking->payment_status == 'expired')
                                        <span class="text-red-500 font-bold">GAGAL / KADALUARSA</span>
                                    @endif
                                </p>
    
                                <!-- Tombol Detail Booking -->
                                <a href="{{ route('user.booking_detail', $booking->id) }}" class="btn btn-link text-blue-600 mt-2">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Anda belum membooking Kendaraan.</p>
                @endforelse
            </div>
        </div>
    </div>
    
</div>
@endsection
