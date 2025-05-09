@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Greeting -->
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-500">Halo, {{ $user->name }} 👋</h1>


    <!-- Filter Kendaraan -->
<div class="mb-6">
    <form method="GET" action="{{ route('user.dashboard') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="input input-bordered w-full" placeholder="Tanggal">
        <input type="text" name="brand" value="{{ request('brand') }}" class="input input-bordered w-full" placeholder="Brand">
        <input type="text" name="model" value="{{ request('model') }}" class="input input-bordered w-full" placeholder="Model">
        <input type="text" name="type" value="{{ request('type') }}" class="input input-bordered w-full" placeholder="Tipe Kendaraan">
        <input type="text" name="nama" value="{{ request('nama') }}" class="input input-bordered w-full" placeholder="Nama Kendaraan">

        <div class="md:col-span-5 flex gap-2">
            <button type="submit" class="btn btn-primary w-full">Cari</button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline w-full">Reset</a>
        </div>
    </form>
</div>

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

@endsection
