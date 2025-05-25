@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 md:p-6">
    <div class="bg-white shadow-xl rounded-lg p-4 md:p-6 space-y-6">
        <!-- Vehicle Name -->
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ $vehicle->vehicle_name }}</h1>

        <!-- Rating and Reviews -->
        <div class="flex items-center space-x-2">
            <div class="flex">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($vehicle->rating))
                        <span class="text-yellow-500">★</span>
                    @elseif($i - 0.5 <= $vehicle->rating)
                        <span class="text-yellow-500">½</span>
                    @else
                        <span class="text-gray-300">☆</span>
                    @endif
                @endfor
            </div>
            <span class="text-gray-600 text-sm">({{ number_format($vehicle->rating, 1) }} from {{ $vehicle->reviews->count() }} reviews)</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Gallery Section -->
            <div class="col-span-1 lg:col-span-2 rounded-lg overflow-hidden">
                @if ($vehicle->galleries->count() > 0)
                    <div class="swiper-container rounded-lg shadow-lg">
                        <div class="swiper-wrapper">
                            @foreach ($vehicle->galleries as $gallery)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}"
                                         alt="{{ $vehicle->vehicle_name }} - Image {{ $loop->iteration }}"
                                         class="w-full h-64 md:h-96 object-cover rounded-lg">
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation and Pagination -->
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next bg-white/30 backdrop-blur-sm rounded-full p-4"></div>
                        <div class="swiper-button-prev bg-white/30 backdrop-blur-sm rounded-full p-4"></div>
                    </div>
                @else
                    <img src="{{ asset('img/default-vehicle.jpg') }}"
                         alt="Default vehicle image"
                         class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">
                @endif
            </div>

            <!-- Vehicle Details Section -->
            <div class="col-span-1 space-y-4">
                <!-- Price & Booking Card -->
                <div class="border border-gray-200 rounded-lg p-4 shadow-sm bg-gray-50 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-xl md:text-2xl font-bold text-[#316783]">
                            Rp {{ number_format($vehicle->price, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/day</span>
                        </p>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                              {{ $vehicle->status == 'available' ? 'bg-green-100 text-green-800' :
                                 ($vehicle->status == 'not available' ? 'bg-red-100 text-red-800' :
                                 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                        </span>
                    </div>

                    @if($vehicle->status == 'available')
                        <a href="{{ route('booking.create', $vehicle->id) }}"
                           class="w-full btn btn-warning text-white py-3 font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center space-x-2">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                               <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                           </svg>
                           <span>Book Now</span>
                        </a>
                    @else
                        <button class="w-full btn btn-disabled py-3 font-semibold rounded-lg cursor-not-allowed">
                            Currently Unavailable
                        </button>
                    @endif
                </div>

                <!-- Vehicle Specifications -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <h2 class="text-lg font-semibold mb-3 border-b pb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                        Vehicle Specifications
                    </h2>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex justify-between py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Type:</span>
                            <span class="text-gray-900">{{ ucfirst($vehicle->vehicle_type) }}</span>
                        </li>
                        <li class="flex justify-between py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Model:</span>
                            <span class="text-gray-900">{{ ucfirst($vehicle->vehicle_model) }}</span>
                        </li>
                        <li class="flex justify-between py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Brand:</span>
                            <span class="text-gray-900">{{ $vehicle->vehicle_brand }}</span>
                        </li>
                        <li class="flex justify-between py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Transmission:</span>
                            <span class="text-gray-900">{{ ucfirst($vehicle->vehicle_transmission) }}</span>
                        </li>
                        <li class="flex justify-between py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-600">Seats:</span>
                            <span class="text-gray-900">{{ $vehicle->seat }}</span>
                        </li>
                        <li class="flex justify-between py-2">
                            <span class="font-medium text-gray-600">Plate Number:</span>
                            <span class="text-gray-900 font-mono">{{ $vehicle->number_plate }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        @if($vehicle->reviews->count() > 0)
        <div class="mt-8 bg-white p-4 md:p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                Customer Reviews ({{ $vehicle->reviews->count() }})
            </h2>

            <div class="space-y-6">
                @foreach($vehicle->reviews->take(3) as $review)
                <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                    <div class="flex items-center mb-2">
                        <div class="flex mr-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <span class="text-yellow-500">★</span>
                                @else
                                    <span class="text-gray-300">☆</span>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>
                    <p class="text-gray-700">{{ $review->comment }}</p>
                    <p class="text-sm text-gray-500 mt-2">- {{ $review->user->name ?? 'Anonymous' }}</p>
                </div>
                @endforeach

                @if($vehicle->reviews->count() > 3)
                <div class="text-center">
                    <a href="#" class="text-[#316783] font-medium hover:underline">View all reviews</a>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Include Swiper JS and CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>

<style>
    .swiper-button-next, .swiper-button-prev {
        color: #316783;
        --swiper-navigation-size: 24px;
        padding: 8px;
    }
    .swiper-pagination-bullet-active {
        background: #316783;
    }
</style>
@endsection