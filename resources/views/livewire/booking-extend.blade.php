<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Extend Booking</h2>

    <div class="mb-4">
        <label for="new_end_date">New End Date:</label>
        <input type="date" id="new_end_date" wire:model="new_end_date" class="border p-2 rounded">
        @error('new_end_date') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label>Payment Method:</label>
        <select wire:model="payment_method" class="border p-2 rounded">
            <option value="">Select Payment Method</option>
            <option value="midtrans">Midtrans</option>
            <option value="transfer">Transfer Manual</option>
        </select>
        @error('payment_method') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <p>Price: <strong>Rp {{ number_format($price, 0, ',', '.') }}</strong></p>
    </div>

    <button wire:click="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
</div>
