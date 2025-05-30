    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow-lg">
        <h1 class="text-2xl font-semibold text-center text-[#316783] mb-4">Extend Vehicle Booking</h1>

        @if (session()->has('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- New End Date -->
        <div class="mb-4">
            <label for="new_end_date" class="block font-semibold text-gray-700">New End Date</label>
            <input type="date" wire:model="new_end_date" id="new_end_date" class="w-full border-gray-300 p-3 rounded-md focus:ring-[#316783] focus:border-[#316783]">
            @error('new_end_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Payment Method -->
        <div class="mb-4">
            <label for="payment_method" class="block font-semibold text-gray-700">Payment Method</label>
            <select wire:model="payment_method" id="payment_method" class="w-full border-gray-300 p-3 rounded-md focus:ring-[#316783] focus:border-[#316783]">
                <option value="">-- Select Payment Method --</option>
                <option value="transfer">Manual Transfer</option>
            </select>
            @error('payment_method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Extension Details -->
        <div class="border-t pt-4 mt-4">
            <h3 class="text-md font-semibold text-[#316783]">Extension Details</h3>
            <ul class="mt-2 text-sm">
                <li><strong>Vehicle Name:</strong> {{ $booking->vehicle->name }}</li>
                <li><strong>Booking Start Date:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y H:i') }}</li>
                <li><strong>Old End Date:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y H:i') }}</li>
                <li><strong>New End Date:</strong> {{ $new_end_date ? \Carbon\Carbon::parse($new_end_date)->format('d M Y') : '-' }}</li>
                <li><strong>Extension Price:</strong> Rp {{ number_format($price, 0, ',', '.') }}</li>
            </ul>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center mt-6">
            <!-- Back Button (left-aligned) -->
            <div class="text-left">
                <a href="{{ route('user.history') }}"
                   class="inline-block text-indigo-600 hover:text-indigo-800 border border-indigo-500 px-5 py-2 rounded-lg font-medium transition">
                    ⬅️ Back to Booking Details
                </a>
            </div>

            <!-- Extend Booking Button (right-aligned) -->
            <div class="text-right">
                <button wire:click="submit" class="btn btn-warning py-3 px-6 rounded-md font-semibold text-white">
                    Extend Booking
                </button>
            </div>
        </div>
    </div>
</div>

