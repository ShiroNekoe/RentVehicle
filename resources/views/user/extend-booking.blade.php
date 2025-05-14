@extends('layouts.app')

@section('content')
    @livewire('booking-extend', ['booking' => $booking])
@endsection
