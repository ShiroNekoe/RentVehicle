@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg space-y-6">
    <h2 class="text-2xl font-semibold text-center text-[#316783]">Extend Booking</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label for="newEndDate" class="block font-medium text-gray-700 mb-2">New End Date:</label>
            <input type="date" wire:model="newEndDate" id="newEndDate"
                class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
            @error('newEndDate') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="paymentMethod" class="block font-medium text-gray-700 mb-2">Payment Method:</label>
            <select wire:model="paymentMethod" id="paymentMethod"
                class="select select-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                <option value="transfer">Transfer</option>
            </select>
            @error('paymentMethod') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Responsive Buttons -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mt-6">
            <a href=""
               class="inline-block text-indigo-600 hover:text-indigo-800 border border-indigo-500 px-5 py-2 rounded-lg font-medium transition text-center md:text-left w-full md:w-auto">
                ⬅️ Back to Booking Details
            </a>

            <button type="submit"
                class="btn btn-warning py-3 px-6 rounded-md font-semibold text-white hover:scale-105 transition-transform duration-200 w-full md:w-auto">
                Extend Booking
            </button>
        </div>
    </form>
</div>
@endsection
