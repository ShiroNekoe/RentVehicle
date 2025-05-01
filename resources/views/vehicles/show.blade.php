
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">{{ $vehicle->name }}</h1>
    <div class="bg-white shadow rounded-lg p-4">
        <img src="{{ asset('storage/iamge/vehicles' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="w-full h-64 object-cover mb-4 rounded">
        <p><strong>nama:</strong>{{$vehicle->vehicle_name}}</p>
        <p><strong>Tipe:</strong> {{ $vehicle->vehicle_type }}</p>
        <p><strong>Model:</strong> {{ $vehicle->vehicle_model }}</p>
        <p><strong>Merek:</strong> {{ $vehicle->vehicle_brand }}</p>
        <p><strong>Transmisi:</strong> {{ $vehicle->vehicle_transmission }}</p>
        <p><strong>Jumlah Kursi:</strong> {{ $vehicle->seat }}</p>
        <p><strong>Harga per hari:</strong> Rp{{ number_format($vehicle->price, 0, ',', '.') }}</p>
        <p><strong>Status:</strong> {{ $vehicle->status }}</p>

        <div class="w-full lg:w-4/12 bg-white rounded-xl p-5 lg:p-10 h-max">
            <p>Price per day: Rp {{ number_format($vehicle->price, 0, ',', '.') }}</p>
            <a href="{{ route('booking.create', $vehicle->id) }}" class="btn btn-primary">Book Now</a>
            
        </div>
        
    </div>
</div>
@endsection
