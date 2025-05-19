@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-xl rounded-lg p-8 space-y-6">
        <!-- Error Message -->
        @if (session()->has('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="submitBooking" enctype="multipart/form-data" class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:space-x-4 justify-between"> <!-- Adjust layout to be responsive -->
                <!-- Pick Up Date & Time -->
                <div class="flex flex-col items-center w-full sm:w-1/2">
                    <label for="start_date" class="text-lg font-semibold text-gray-700">Pick Up Date & Time</label>
                    <div class="flex items-center space-x-2">
                        <input type="date" wire:model.defer="start_date" id="start_date" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300">
                        <span class="text-gray-600 text-sm">at</span>
                        <input type="time" wire:model.defer="start_time" id="start_time" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300">
                    </div>
                    @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Return Date & Time -->
                <div class="flex flex-col items-center w-full sm:w-1/2">
                    <label for="end_date" class="text-lg font-semibold text-gray-700">Return Date & Time</label>
                    <div class="flex items-center space-x-2">
                        <input type="date" wire:model.defer="end_date" id="end_date" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300">
                        <span class="text-gray-600 text-sm">at</span>
                        <input type="time" wire:model.defer="end_time" id="end_time" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300">
                    </div>
                    @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Driver Selection (Optional) -->
            <div>
                <label for="id_driver" class="text-lg font-semibold text-gray-700">Choose Driver (Optional)</label>
                <select wire:model="id_driver" id="id_driver" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300">
                    <option value="">-- No Driver --</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pickup Location -->
            <div>
                <label for="pickup_location" class="text-lg font-semibold text-gray-700">Pick-up Location</label>
                <input type="text" wire:model.defer="pickup_location" id="pickup_location" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300" placeholder="Enter pick-up location">
                @error('pickup_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Personal Phone Number -->
            <div>
                <label for="phone_person" class="text-lg font-semibold text-gray-700">Personal Phone Number</label>
                <input type="text" wire:model.defer="phone_person" id="phone_person" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300" placeholder="Enter your personal phone number">
                @error('phone_person') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Security/Family Phone Number -->
            <div>
                <label for="phone_security" class="text-lg font-semibold text-gray-700">Security/Family Phone Number</label>
                <input type="text" wire:model.defer="phone_security" id="phone_security" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300" placeholder="Enter a family/security phone number">
                @error('phone_security') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- National ID (NIK) -->
            <div>
                <label for="nik_identity" class="text-lg font-semibold text-gray-700">National ID (NIK)</label>
                <input type="text" wire:model.defer="nik_identity" id="nik_identity" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300" placeholder="Enter your NIK">
                @error('nik_identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Identity Upload (jpg/png/pdf) -->
            <div>
                <label for="identity" class="text-lg font-semibold text-gray-700">Upload Identity (jpg/png/pdf)</label>
                <input type="file" wire:model="identity" id="identity" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300">
                @error('identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if ($identity)
                    <p class="text-green-600 mt-1">File uploaded: {{ $identity->getClientOriginalName() }}</p>
                @endif
            </div>

            <!-- Payment Method -->
            <div>
                <label for="payment_method" class="text-lg font-semibold text-gray-700">Payment Method</label>
                <select wire:model.defer="payment_method" id="payment_method" class="w-full border rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-blue-600 transition duration-300">
                    <option value="">-- Choose Payment Method --</option>
                    <option value="transfer">Bank Transfer</option>
                    <option value="cod">Cash on Delivery (COD)</option>
                </select>
            </div>

            <!-- Summary Section -->
            <div class="bg-gray-100 p-4 rounded-lg mt-4">
                <p class="text-lg"><strong>Duration:</strong> {{ $days }} days</p>
                <p class="text-lg"><strong>Total Price:</strong> Rp {{ number_format($total_price, 0, ',', '.') }}</p>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                    Book Now
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
