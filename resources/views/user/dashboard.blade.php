@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

<!-- Filter Kendaraan -->
<div class="mb-10">
    <form method="GET" action="{{ route('user.dashboard') }}" class="bg-white shadow-md rounded-xl p-6 space-y-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">🔎 Filter Kendaraan</h2>

        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            {{-- Brand --}}
            <div>
                <label for="brand" class="text-sm font-medium text-gray-700 mb-1 block">Brand</label>
                <select name="brand" id="brand" class="select select-bordered w-full">
                    <option value="">Pilih Brand</option>
                    @foreach (['Honda','Toyota','Daihatsu','Suzuki','Mitsubishi','Yamaha'] as $brand)
                        <option value="{{ $brand }}" @selected(request('brand') == $brand)>{{ $brand }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Model --}}
            <div>
                <label for="model" class="text-sm font-medium text-gray-700 mb-1 block">Model</label>
                <select name="model" id="model" class="select select-bordered w-full">
                    <option value="">Pilih Model</option>
                    @foreach (['big','medium','small'] as $model)
                        <option value="{{ $model }}" @selected(request('model') == $model)>{{ ucfirst($model) }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="text-sm font-medium text-gray-700 mb-1 block">Tipe Kendaraan</label>
                <select name="type" id="type" class="select select-bordered w-full">
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach (['car','motorcycles'] as $type)
                        <option value="{{ $type }}" @selected(request('type') == $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Transmission --}}
            <div>
                <label for="transmission" class="text-sm font-medium text-gray-700 mb-1 block">Transmisi</label>
                <select name="transmission" id="transmission" class="select select-bordered w-full">
                    <option value="">Pilih Transmisi</option>
                    @foreach (['matic','manual'] as $trans)
                        <option value="{{ $trans }}" @selected(request('transmission') == $trans)>{{ ucfirst($trans) }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Seat --}}
            <div>
                <label for="seat" class="text-sm font-medium text-gray-700 mb-1 block">Jumlah Kursi</label>
                <select name="seat" id="seat" class="select select-bordered w-full">
                    <option value="">Jumlah Kursi</option>
                    @foreach (['2','5','8','12-20'] as $seat)
                        <option value="{{ $seat }}" @selected(request('seat') == $seat)>{{ $seat }} Kursi</option>
                    @endforeach
                </select>
            </div>

            {{-- Nama Kendaraan --}}
            <div>
                <label for="nama" class="text-sm font-medium text-gray-700 mb-1 block">Nama Kendaraan</label>
                <input type="text" name="nama" id="nama" value="{{ request('nama') }}" class="input input-bordered w-full" placeholder="Contoh: Avanza, Vario...">
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col md:flex-row gap-7 pt-3 ">
            <button type="submit" class="btn btn-primary w-full md:w-auto">🔍 Cari</button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline w-full md:w-auto">🔁 Reset</a>
        </div>
    </form>
</div>


    <!-- Kendaraan Populer -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-red-500">Kendaraan yang Sering di Booking</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($popularVehicles as $vehicle)
                <div class="card w-full bg-base-100 shadow-xl">
                   @php
                        $firstImage = $vehicle->galleries->first();
                    @endphp

                    @if ($firstImage)
                        <img src="{{ asset('storage/vehicles/' . $firstImage->image_path) }}" class="object-cover h-40 w-full">
                    @else
                        <img src="{{ asset('images/default-vehicle.jpg') }}" class="object-cover h-40 w-full" alt="Tidak ada gambar">
                    @endif
                    <div class="card-body">
                        <h3 class="text-xl font-bold">{{ $vehicle->vehicle_name }}</h3>
                        <p class="text-gray-600">{{ $vehicle->vehicle_type }} - {{ $vehicle->price }} per hari</p>
                        <p class="text-sm text-gray-500">Total Booking: {{ $vehicle->bookings_count }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-warning">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Kendaraan Tersedia -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-4">Kendaraan Tersedia</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($vehicles as $vehicle)
                <div class="card w-full bg-base-100 shadow-xl">
                    <figure>
                        <img src="{{ asset('storage/vehicles/' . $vehicle->image_path) }}" class="object-cover h-40 w-full">
                    </figure>
                    <div class="card-body">
                        <h3 class="text-xl font-bold">{{ $vehicle->vehicle_name }}</h3>
                        <p class="text-gray-600">{{ $vehicle->vehicle_type }} - {{ $vehicle->price }} per hari</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
