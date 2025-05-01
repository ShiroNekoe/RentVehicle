@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Greeting -->
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-500">Halo, {{ $user->name }} 👋</h1>

    <!-- Kendaraan Tersedia -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-4">Kendaraan Tersedia</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($vehicles as $vehicle)
                <div class="card w-full bg-base-100 shadow-xl">
                    <figure>
                        <img src="{{ asset('public/storage/vehicles'.$vehicle->image_path) }}" alt="{{ $vehicle->name }}" class="object-cover h-40 w-full">
                    </figure>
                    <div class="card-body">
                        <h3 class="text-xl font-bold">{{ $vehicle->name }}</h3>
                        <p class="text-gray-600">{{ $vehicle->type }} - {{ $vehicle->price }} per hari</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Riwayat Pemesanan -->
    <div>
        <h2 class="text-2xl font-semibold mb-4">Riwayat Pemesanan</h2>
        <ul class="space-y-2">
            @forelse ($bookings as $booking)
                <li class="flex items-center p-4 border border-gray-300 rounded-lg">
                    <span class="mr-4 text-lg">🚗</span>
                    <div>
                        <p class="font-semibold">{{ $booking->vehicle->name }} ({{ $booking->status }})</p>
                        <p class="text-sm text-gray-500">Tanggal Pemesanan: {{ $booking->created_at->format('d M Y') }}</p>
                    </div>
                </li>
            @empty
                <li class="p-4 text-gray-500">Belum ada pemesanan.</li>
            @endforelse
        </ul>
    </div>

    <!-- payment-->
    <div>
        <h2 class="text-2xl font-semibold mb-4">Riwayat Booking</h2>
        <ul class="space-y-2">
            @forelse ($bookings as $booking)
                <li class="flex flex-col md:flex-row md:items-center p-4 border border-gray-300 rounded-lg">
                    <div class="flex items-center">
                        <span class="mr-4 text-lg">🚗</span>
                        <div>
                            <p class="font-semibold">{{ $booking->vehicle->vehicle_name }} ({{ $booking->booking_status }})</p>
                            <p class="text-sm text-gray-500">Tanggal Pemesanan: {{ $booking->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
    
                    <!-- Status Pembayaran -->
                    <div class="mt-2 md:mt-0 md:ml-auto">
                        <p>Status Pembayaran:
                            @if ($booking->payment_status == 'paid')
                                <span class="text-green-500 font-bold">LUNAS</span>
                            @elseif ($booking->payment_status == 'pending')
                                <span class="text-yellow-500 font-bold">MENUNGGU PEMBAYARAN</span>
                            @elseif ($booking->payment_status == 'failed' || $booking->payment_status == 'expired')
                                <span class="text-red-500 font-bold">GAGAL / KADALUARSA</span>
                            @endif
                        </p>
                    </div>
                </li>
            @empty
                <li class="p-4 text-gray-500">Anda belum membooking Kendaraan.</li>
            @endforelse
        </ul>
    </div>
@endsection
