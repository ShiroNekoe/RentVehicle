@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Filter dan Pencarian Kendaraan -->
    <div class="flex flex-col md:flex-row gap-6">

        <!-- Sidebar Filter (Desktop) -->
        <div class="hidden md:block w-1/4 bg-white shadow-md rounded-lg p-6 space-y-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter</h3>

            <!-- Brand Filter -->
            <div>
                <label for="brand" class="text-sm font-medium text-gray-700 mb-1 block">Brand</label>
                <select name="brand" id="brand" class="select select-bordered w-full">
                    <option value="">Choice Brand</option>
                    @foreach (['Honda','Toyota','Daihatsu','Suzuki','Mitsubishi','Yamaha'] as $brand)
                        <option value="{{ $brand }}" @selected(request('brand') == $brand)>{{ $brand }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Model Filter -->
            <div>
                <label for="model" class="text-sm font-medium text-gray-700 mb-1 block">Model</label>
                <select name="model" id="model" class="select select-bordered w-full">
                    <option value="">Choice Model</option>
                    @foreach (['big','medium','small'] as $model)
                        <option value="{{ $model }}" @selected(request('model') == $model)>{{ ucfirst($model) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="text-sm font-medium text-gray-700 mb-1 block">Vehicle Type</label>
                <select name="type" id="type" class="select select-bordered w-full">
                    <option value="">Choice Vehicle Type</option>
                    @foreach (['car','motorcycles'] as $type)
                        <option value="{{ $type }}" @selected(request('type') == $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Transmission Filter -->
            <div>
                <label for="transmission" class="text-sm font-medium text-gray-700 mb-1 block">Transmission</label>
                <select name="transmission" id="transmission" class="select select-bordered w-full">
                    <option value="">Choice Transmission</option>
                    @foreach (['matic','manual'] as $trans)
                        <option value="{{ $trans }}" @selected(request('transmission') == $trans)>{{ ucfirst($trans) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Seat Filter -->
            <div>
                <label for="seat" class="text-sm font-medium text-gray-700 mb-1 block">Seat</label>
                <select name="seat" id="seat" class="select select-bordered w-full">
                    <option value="">Number of Seat</option>
                    @foreach (['2','5','8','12-20'] as $seat)
                        <option value="{{ $seat }}" @selected(request('seat') == $seat)>{{ $seat }} Seat</option>
                    @endforeach
                </select>
            </div>

            <!-- Apply and Reset Filters -->
            <div class="flex flex-col gap-4 pt-4">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline w-full">Reset</a>
            </div>
        </div>

        <!-- Pencarian Nama Kendaraan (Tengah) -->
        <div class="w-full md:w-3/4">
            <div class="flex justify-center mb-6">
                <form method="GET" action="{{ route('user.dashboard') }}" class="w-full max-w-2xl">
                    <div class="relative">
                        <!-- Input Nama Kendaraan -->
                        <input type="text" name="nama" id="nama" value="{{ request('nama') }}"
                               class="input input-bordered w-full text-xl py-3 px-6 rounded-fulliyaa"
                               placeholder="Search Vehicle">
                        <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6M16 11a7 7 0 10-9 9 7 7 0 009-9z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Hasil Pencarian Kendaraan -->
            @if($popularVehicles->isEmpty())
                <div class="text-center text-lg text-gray-600">
                    <p>Data Tidak Ditemukan</p>
                    <h3 class="text-xl text-gray-800 mt-4">Rekomendasi Kendaraan:</h3>

                    <!-- Rekomendasi Kendaraan Populer -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        @foreach($recommendedVehicles as $vehicle)  <!-- Assuming $recommendedVehicles contains the vehicles for recommendation -->
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                @php
                                    $firstImage = $vehicle->galleries->first();
                                @endphp

                                @if ($firstImage)
                                    <img src="{{ asset('storage/vehicles/' . $firstImage->image_path) }}" class="object-cover h-40 w-full">
                                @else
                                    <img src="{{ asset('images/default-vehicle.jpg') }}" class="object-cover h-40 w-full" alt="Tidak ada gambar">
                                @endif

                                <div class="p-4">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $vehicle->brand }} - {{ $vehicle->model }}</h3>
                                    <p class="text-sm text-gray-600">{{ $vehicle->seat }} Seat | {{ $vehicle->transmission }} | {{ $vehicle->vehicle_type }}</p>
                                    <p class="text-lg text-gray-900 font-bold mt-2">{{ $vehicle->price }} /day</p>

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
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">({{ $vehicle->rating }})</span>
                                    </div>

                                    <div class="mt-4 text-right">
                                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-warning text-white px-6 py-2 rounded-lg">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Menampilkan kendaraan yang sesuai dengan pencarian -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($popularVehicles as $vehicle)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                            @php
                                $firstImage = $vehicle->galleries->first();
                            @endphp

                            @if ($firstImage)
                                <img src="{{ asset('storage/vehicles/' . $firstImage->image_path) }}" class="object-cover h-40 w-full">
                            @else
                                <img src="{{ asset('images/default-vehicle.jpg') }}" class="object-cover h-40 w-full" alt="Tidak ada gambar">
                            @endif

                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $vehicle->brand }} - {{ $vehicle->model }}</h3>
                                <p class="text-sm text-gray-600">{{ $vehicle->seat }} Seat | {{ $vehicle->transmission }} | {{ $vehicle->vehicle_type }}</p>
                                <p class="text-lg text-gray-900 font-bold mt-2">{{ $vehicle->price }} /day</p>
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
                                    </span>
                                    <span class="ml-2 text-sm text-gray-500">({{ $vehicle->rating }})</span>
                                </div>
                                <div class="mt-4 text-right">
                                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-warning text-white px-6 py-2 rounded-lg">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
