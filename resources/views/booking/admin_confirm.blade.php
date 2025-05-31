@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-white px-4 py-8">
    <div class="p-8 bg-white rounded-lg shadow-md w-full max-w-lg text-center space-y-6">
        <h2 class="text-2xl font-semibold text-[#316783] mb-4">Booking Has Been Successfully Cancelled!</h2>
        <p class="text-lg text-gray-700 mb-6">Please contact the admin for further confirmation.</p>

        <!-- WhatsApp Button -->
        <a href="https://wa.link/bpa8c7" target="_blank" class="btn btn-success text-white font-semibold py-3 px-6 rounded-md hover:bg-[#128C7E] transition-colors">
            Contact Admin via WhatsApp
        </a>
    </div>
</div>
@endsection
