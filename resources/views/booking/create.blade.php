
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <livewire:booking-form :vehicleId="$vehicle->id" />
    </div>
@endsection
