@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-xl rounded-lg p-4 space-y-6">
        <!-- Vehicle Name -->
        <h1 class="text-3xl font-extrabold text-gray-900">{{ $vehicle->vehicle_name }}</h1> 

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Swiper Gallery (Smaller and responsive) -->
            <div class="col-span-1 lg:col-span-2 rounded-lg overflow-hidden shadow-xl">
                @if ($vehicle->galleries->count() > 1)
                    <!-- Swiper Gallery -->
                    <div class="swiper-container rounded-lg">
                        <div class="swiper-wrapper">
                            @foreach ($vehicle->galleries as $gallery)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/vehicles/' . $gallery->image_path) }}" alt="{{ $vehicle->vehicle_name }}" 
                                         class="w-full h-[250px] object-cover rounded-lg transition-transform duration-300 hover:scale-105" /> 
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination mt-4"></div>

                        <!-- Navigation Buttons -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                @else
                    <!-- Single Image Gallery -->
                    @php
                        $firstImage = $vehicle->galleries->first();
                    @endphp
                    @if ($firstImage)
                        <img src="{{ asset('storage/vehicles/' . $firstImage->image_path) }}" alt="{{ $vehicle->vehicle_name }}" 
                             class="w-full h-[250px] object-cover rounded-lg">
                    @else
                        <img src="{{ asset('images/default-vehicle.jpg') }}" alt="No image available" 
                             class="w-full h-[250px] object-cover rounded-lg"> 
                    @endif
                @endif
            </div>

            <!-- Vehicle Details (Sidebar kanan) -->
            <div class="col-span-1 space-y-4">
                <!-- Price & Booking Button -->
                <div class="flex flex-col space-y-3 p-4 border rounded-lg shadow-sm bg-gray-50">
                    <p class="text-2xl font-bold text-[#316783] ">Rp {{ number_format($vehicle->price, 0, ',', '.') }} / day</p> 
                    <a href="{{ route('booking.create', $vehicle->id) }}" 
                       class="btn btn-warning text-white rounded-lg py-2 font-semibold shadow-md text-center transition duration-300 transform hover:scale-105"> <!-- Reduced padding and font size -->
                       Book Now
                    </a>
                </div>

                <!-- Detailed Info -->
                <div class="bg-white p-4 rounded-lg shadow-md border hover:shadow-xl transition-shadow duration-300"> <!-- Reduced padding -->
                    <h2 class="text-lg font-semibold mb-4 border-b pb-2">Vehicle Details</h2> <!-- Reduced text size -->
                    <ul class="space-y-3 text-gray-700">
                        <li><strong>Type:</strong> {{ $vehicle->vehicle_type }}</li>
                        <li><strong>Model:</strong> {{ $vehicle->vehicle_model }}</li>
                        <li><strong>Brand:</strong> {{ $vehicle->vehicle_brand }}</li>
                        <li><strong>Transmission:</strong> {{ ucfirst($vehicle->vehicle_transmission) }}</li>
                        <li><strong>Seats:</strong> {{ $vehicle->seat }}</li>
                        <li><strong>Status:</strong> <span class="{{ $vehicle->status == 'available' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($vehicle->status) }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper with navigation buttons
    var swiper = new Swiper('.swiper-container', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

@endsection
