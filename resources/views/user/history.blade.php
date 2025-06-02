@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-center text-gray-800 my-10">Your Rental Journey, Recapped</h1>
<div class="container mx-auto p-6 max-w-7xl">
    <div class="space-y-10">
        <!-- Filter Section -->
        <form method="GET" action="{{ route('user.history') }}" class="bg-white p-6 rounded-xl shadow-md border mb-6">
            <div class="flex items-center space-x-4">
                <!-- Filter Booking Status -->
                <div class="flex-1">
                    <select name="booking_status" id="booking_status" class="w-full border rounded-lg px-4 py-2 text-sm">
                        <option value="">All Status</option>
                        <option value="ongoing" {{ request('booking_status') == 'ongoing' ? 'selected' : '' }}>OnGoing</option>
                        <option value="completed" {{ request('booking_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('booking_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Search and Reset Buttons -->
                <div class="flex space-x-2">
                    <button type="submit" class="btn btn-warning w-24">Search</button>
                    <a href="{{ route('user.history') }}" class="btn btn-outline w-24">Reset</a>
                </div>
            </div>
        </form>

        <!-- Booking History -->
        <div>
            @if ($bookings->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($bookings as $booking)
                        <div class="bg-white shadow-md rounded-xl p-5 border hover:shadow-xl transition duration-300 hover:scale-105">
                            <div class="relative">
                                <!-- Vehicle Image -->
                              @if($booking->vehicle && $booking->vehicle->galleries->isNotEmpty())
                                    <img src="{{ asset('storage/' . $booking->vehicle->galleries->first()->image_path) }}" alt="{{ $booking->vehicle->vehicle_name }}" class="w-full h-48 object-cover">
                                @else
                                    <img src="{{ asset('img/default-vehicle.jpg') }}" alt="Default Vehicle" class="w-full h-48 object-cover">
                                @endif

                            </div>
                            <div class="mt-3">
                                <div class="absolute top-2 left-2 bg-white text-blue-500 px-3 py-1 text-xs rounded-md">
                                    {{ ucfirst($booking->booking_status) }}
                                </div>
                                <!-- Vehicle Name -->
                                <h3 class="text-lg font-semibold text-gray-700">{{ $booking->vehicle->vehicle_name }}</h3>

                                <!-- Booking Date -->
                                <p class="text-sm text-gray-500 mb-1">Booking Date: {{ $booking->created_at->format('d M Y') }}</p>

                                <!-- Price -->
                                <p class="text-sm text-[#316783] font-semibold mb-2">Rp {{ number_format($booking->vehicle->price, 0, ',', '.') }} / day</p>

                                <!-- View Detail Button -->
                                <div class="mt-4 text-right">
                                    <a href="{{ route('user.booking_detail', $booking->id) }}" class="btn btn-warning text-white px-6 py-2 rounded-lg">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 mt-8">No results found based on the filter.</div>
            @endif
        </div>
    </div>
</div>
@endsection
