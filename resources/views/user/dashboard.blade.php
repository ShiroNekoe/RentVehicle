@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-center text-gray-800 my-10">Select the Wheels for Your Journey</h1>

<div class="container mx-auto p-6 max-w-7xl" x-data="{ open: false }" x-init="open = false">
    <!-- Vehicle Filter -->
    <div class="mb-10">
        <form method="GET" action="{{ route('user.dashboard') }}" class="bg-white shadow-md rounded-xl p-6 space-y-4">
            {{-- Vehicle Name --}}
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <input type="text" name="nama" id="nama" value="{{ request('nama') }}" class="input input-bordered w-full" placeholder="Vehicle">
                </div>

                <!-- Search and Reset Buttons -->
                <div class="flex space-x-2">
                    <button type="submit" class="btn btn-warning">Search</button>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline w-24">Reset</a>
                </div>
            </div>

            <!-- Toggle Filter Button -->
            <button type="button" @click="open = !open" class="flex items-center text-[#316783]">
                <span x-text="open ? 'Hide Filters' : 'Show Filters'"></span>
                <svg x-show="!open" class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <svg x-show="open" class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 15l-7-7-7 7"></path>
                </svg>
            </button>

            <!-- Filters visible only when toggle is active -->
            <div x-show="open" x-transition class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                {{-- Brand --}}
                <div>
                    <label for="brand" class="text-sm font-medium text-gray-700 mb-1 block">Brand</label>
                    <select name="brand" id="brand" class="select select-bordered w-full">
                        <option value="">Select Brand</option>
                        @foreach (['Honda','Toyota','Daihatsu','Suzuki','Mitsubishi','Yamaha'] as $brand)
                            <option value="{{ $brand }}" @selected(request('brand') == $brand)>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Model --}}
                <div>
                    <label for="model" class="text-sm font-medium text-gray-700 mb-1 block">Model</label>
                    <select name="model" id="model" class="select select-bordered w-full">
                        <option value="">Select Model</option>
                        @foreach (['big','medium','small'] as $model)
                            <option value="{{ $model }}" @selected(request('model') == $model)>{{ ucfirst($model) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Type --}}
                <div>
                    <label for="type" class="text-sm font-medium text-gray-700 mb-1 block">Vehicle Type</label>
                    <select name="type" id="type" class="select select-bordered w-full">
                        <option value="">Select Vehicle Type</option>
                        @foreach (['car','motorcycles'] as $type)
                            <option value="{{ $type }}" @selected(request('type') == $type)>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Transmission --}}
                <div>
                    <label for="transmission" class="text-sm font-medium text-gray-700 mb-1 block">Transmission</label>
                    <select name="transmission" id="transmission" class="select select-bordered w-full">
                        <option value="">Select Transmission</option>
                        @foreach (['matic','manual'] as $trans)
                            <option value="{{ $trans }}" @selected(request('transmission') == $trans)>{{ ucfirst($trans) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Seat --}}
                <div>
                    <label for="seat" class="text-sm font-medium text-gray-700 mb-1 block">Number of Seats</label>
                    <select name="seat" id="seat" class="select select-bordered w-full">
                        <option value="">Number of Seats</option>
                        @foreach (['2','5','8','12-20'] as $seat)
                            <option value="{{ $seat }}" @selected(request('seat') == $seat)>{{ $seat }} Seats</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Available Vehicles -->
    <div class="mb-6">
        @if($vehicles->isEmpty())
            <p class="text-lg text-center text-gray-600">Sorry, no vehicles available</p>

            <!-- Recommended Popular Vehicles -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4 text-[#316783]">Recommended Popular Vehicles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($popularVehicles as $vehicle)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                            @if($vehicle->galleries->isNotEmpty())
                                <img src="{{ asset('storage/' . $vehicle->galleries->first()->image_path) }}" alt="{{ $vehicle->vehicle_name }}" class="w-full h-48 object-cover">
                            @else
                                <img src="{{ asset('img/default-vehicle.jpg') }}" alt="Default Vehicle" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $vehicle->vehicle_name }} - {{ $vehicle->vehicle_brand }}</h3>
                                <p class="text-sm text-gray-600">{{ $vehicle->seat }} Seat | {{ ucfirst($vehicle->vehicle_transmission) }} | {{ ucfirst($vehicle->vehicle_type) }}</p>
                                <p class="text-lg text-gray-900 font-bold mt-2">Rp {{ number_format($vehicle->price, 0, ',', '.') }} /day</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-500">
                                        @for ($i = 0; $i < floor($vehicle->rating); $i++)
                                            ★
                                        @endfor
                                        @if ($vehicle->rating - floor($vehicle->rating) >= 0.5)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                        @for ($i = ceil($vehicle->rating); $i < 5; $i++)
                                            ☆
                                        @endfor
                                    </span>
                                    <span class="ml-2 text-sm text-gray-500">({{ number_format($vehicle->rating, 1) }})</span>
                                </div>
                                <div class="mt-4 text-right">
                                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-warning text-white px-6 py-2 rounded-lg">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($vehicles as $vehicle)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                        @if($vehicle->galleries->isNotEmpty())
                            <img src="{{ asset('storage/' . $vehicle->galleries->first()->image_path) }}" alt="{{ $vehicle->vehicle_name }}" class="w-full h-48 object-cover">
                        @else
                            <img src="{{ asset('img/default-vehicle.jpg') }}" alt="Default Vehicle" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $vehicle->vehicle_name }} - {{ $vehicle->vehicle_brand }}</h3>
                            <p class="text-sm text-gray-600">{{ $vehicle->seat }} Seat | {{ ucfirst($vehicle->vehicle_transmission) }} | {{ ucfirst($vehicle->vehicle_type) }}</p>
                            <p class="text-lg text-gray-900 font-bold mt-2">Rp {{ number_format($vehicle->price, 0, ',', '.') }} /day</p>
                            <div class="flex items-center mt-2">
                                <span class="text-yellow-500">
                                    @for ($i = 0; $i < floor($vehicle->rating); $i++)
                                        ★
                                    @endfor
                                    @if ($vehicle->rating - floor($vehicle->rating) >= 0.5)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                    @for ($i = ceil($vehicle->rating); $i < 5; $i++)
                                        ☆
                                    @endfor
                                </span>
                                <span class="ml-2 text-sm text-gray-500">({{ number_format($vehicle->rating, 1) }})</span>
                            </div>
                            <div class="mt-4 text-right">
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-warning text-white px-6 py-2 rounded-lg">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
