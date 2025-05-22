<div class="p-6 bg-white rounded shadow-md max-w-lg mx-auto space-y-4">
    <h2 class="text-xl font-bold mb-4">Perpanjang Booking Kendaraan</h2>

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-4">
        <label for="new_end_date" class="block font-semibold">Tanggal Akhir Baru</label>
        <input type="date" wire:model="new_end_date" id="new_end_date" class="w-full border rounded px-3 py-2 mt-1">
        @error('new_end_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="payment_method" class="block font-semibold">Metode Pembayaran</label>
        <select wire:model="payment_method" id="payment_method" class="w-full border rounded px-3 py-2 mt-1">
            <option value="">-- Pilih Metode --</option>
            <option value="transfer">Transfer Manual</option>
        </select>
        @error('payment_method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="border-t pt-4 mt-4">
        <h3 class="text-md font-semibold">Detail Perpanjangan</h3>
        <ul class="mt-2 text-sm">
            <li><strong>Nama Kendaraan:</strong> {{ $booking->vehicle->name }}</li>
            <li><strong>Tanggal Awal Booking:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y H:i') }}</li>
            <li><strong>Tanggal Akhir Lama:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y H:i') }}</li>
            <li><strong>Tanggal Akhir Baru:</strong> {{ $new_end_date ? \Carbon\Carbon::parse($new_end_date)->format('d M Y') : '-' }}</li>
            <li><strong>Harga Perpanjangan:</strong> Rp {{ number_format($price, 0, ',', '.') }}</li>
        </ul>
    </div>

    <button wire:click="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Perpanjang Booking
    </button>
</div>
