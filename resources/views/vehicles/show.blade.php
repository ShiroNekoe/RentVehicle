<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

@extends('layouts.app')


@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow rounded-lg p-6 space-y-6">
        <!-- Vehicle Name -->
        <h1 class="text-3xl font-bold text-gray-800">{{ $vehicle->vehicle_name }}</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Swiper Gallery -->
            <div class="w-full bg-gray-200 rounded-lg overflow-hidden shadow">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Loop through vehicle galleries -->
                        @foreach ($vehicle->galleries as $gallery)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/vehicles/' . $gallery->image_path) }}" alt="{{ $vehicle->vehicle_name }}" class="w-full h-64 object-cover">
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <!-- Vehicle Details -->
            <div class="space-y-4">
                <p><strong>Nama:</strong> {{ $vehicle->vehicle_name }}</p>
                <p><strong>Tipe:</strong> {{ $vehicle->vehicle_type }}</p>
                <p><strong>Model:</strong> {{ $vehicle->vehicle_model }}</p>
                <p><strong>Merek:</strong> {{ $vehicle->vehicle_brand }}</p>
                <p><strong>Transmisi:</strong> {{ $vehicle->vehicle_transmission }}</p>
                <p><strong>Jumlah Kursi:</strong> {{ $vehicle->seat }}</p>
                <p><strong>Harga per hari:</strong> Rp{{ number_format($vehicle->price, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($vehicle->status) }}</p>
                
                <div class="flex items-center space-x-4">
                    <p class="text-lg font-semibold">Price per day: Rp {{ number_format($vehicle->price, 0, ',', '.') }}</p>
                    <a href="{{ route('booking.create', $vehicle->id) }}" class="btn btn-primary text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg shadow-md">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 2,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

@endsection
