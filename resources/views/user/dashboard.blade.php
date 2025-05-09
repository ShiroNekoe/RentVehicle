@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Greeting -->
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-500">Halo, {{ $user->name }} 👋</h1>


    <!-- Filter Kendaraan -->
<div class="mb-6">
    <form method="GET" action="{{ route('user.dashboard') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
        {{-- Brand --}}
        <select name="brand" class="select select-bordered w-full">
            <option value="">Pilih Brand </option>
            @foreach (['Honda','Toyota','Daihatsu','Suzuki','Mitsubishi','Yamaha'] as $brand)
                <option value="{{ $brand }}" @selected(request('brand') == $brand)>{{ $brand }}</option>
            @endforeach
        </select>
    
        {{-- Model --}}
        <select name="model" class="select select-bordered w-full">
            <option value="">Pilih Model</option>
            @foreach (['big','medium','small'] as $model)
                <option value="{{ $model }}" @selected(request('model') == $model)>{{ ucfirst($model) }}</option>
            @endforeach
        </select>
    
        {{-- Type --}}
        <select name="type" class="select select-bordered w-full">
            <option value="">Pilih Tipe Kendaraan</option>
            @foreach (['car','motorcycles'] as $type)
                <option value="{{ $type }}" @selected(request('type') == $type)>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
    
        {{-- Transmission --}}
        <select name="transmission" class="select select-bordered w-full">
            <option value="">Pilih Transmisi</option>
            @foreach (['matic','manual'] as $trans)
                <option value="{{ $trans }}" @selected(request('transmission') == $trans)>{{ ucfirst($trans) }}</option>
            @endforeach
        </select>
    
        {{-- Seat --}}
        <select name="seat" class="select select-bordered w-full">
            <option value="">Jumlah Kursi</option>
            @foreach (['2','5','8','12-20'] as $seat)
                <option value="{{ $seat }}" @selected(request('seat') == $seat)>{{ $seat }} Kursi</option>
            @endforeach
        </select>
    
        {{-- Nama Kendaraan --}}
        <input type="text" name="nama" value="{{ request('nama') }}" class="input input-bordered w-full" placeholder="Nama Kendaraan">
    
        {{-- Tombol Aksi --}}
        <div class="md:col-span-6 flex gap-2">
            <button type="submit" class="btn btn-primary w-full">Cari</button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline w-full">Reset</a>
        </div>
    </form>
    
</div>

    <!-- Kendaraan Populer -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-red-500">Kendaraan yang Sering di Booking</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($popularVehicles as $vehicle)
                <div class="card w-full bg-base-100 shadow-xl">
                    <figure>
                        <img src="{{ asset('storage/vehicles/' . $vehicle->image_path) }}" class="object-cover h-40 w-full">
                    </figure>
                    <div class="card-body">
                        <h3 class="text-xl font-bold">{{ $vehicle->name }}</h3>
                        <p class="text-gray-600">{{ $vehicle->type }} - {{ $vehicle->price }} per hari</p>
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

@endsection
