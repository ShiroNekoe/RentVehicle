<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h2 class="text-xl font-bold text-indigo-600 mb-4">Perpanjang Booking</h2>

    <p class="text-gray-700 mb-2">Kendaraan: <strong>{{ $booking->vehicle->vehicle_name }}</strong></p>
    <p class="text-gray-600 mb-4">Tanggal Selesai Saat Ini: <strong>{{ $booking->end_date }}</strong></p>

    <div class="mb-4">
        <label class="block text-sm font-medium">Tanggal Selesai Baru</label>
        <input type="date" wire:model="new_end_date" class="mt-1 block w-full border rounded p-2">
        @error('new_end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    @if ($price)
        <p class="text-indigo-600 font-bold mb-2">Total Tambahan: Rp {{ number_format($price, 0, ',', '.') }}</p>
    @endif

    <div class="mb-4">
        <label class="block text-sm font-medium">Metode Pembayaran</label>
        <select wire:model="payment_method" class="mt-1 block w-full border rounded p-2">
            <option value="">-- Pilih Metode --</option>
            <option value="midtrans">Bayar Otomatis (Midtrans)</option>
            <option value="transfer">Transfer Manual</option>
        </select>
        @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <button wire:click="submit"
        class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
        Perpanjang
    </button>
</div>
