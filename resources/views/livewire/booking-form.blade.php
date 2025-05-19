<!-- resources/views/livewire/booking-form.blade.php -->
<div>
    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="submitBooking" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" wire:model.defer="start_date" id="start_date" class="w-full border rounded p-2">
            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="end_date">Tanggal Selesai</label>
            <input type="date" wire:model.defer="end_date" id="end_date" class="w-full border rounded p-2">
            @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="id_driver">Pilih Sopir (Opsional)</label>
            <select wire:model="id_driver" id="id_driver" class="w-full border rounded p-2">
                <option value="">-- Tanpa Sopir --</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="pickup_location">Lokasi Penjemputan</label>
            <input type="text" wire:model.defer="pickup_location" id="pickup_location" class="w-full border rounded p-2">
            @error('pickup_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="phone_person">No. HP Pribadi</label>
            <input type="text" wire:model.defer="phone_person" id="phone_person" class="w-full border rounded p-2">
            @error('phone_person') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="phone_security">No. HP Keluarga/Keamanan</label>
            <input type="text" wire:model.defer="phone_security" id="phone_security" class="w-full border rounded p-2">
            @error('phone_security') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="nik_identity">NIK</label>
            <input type="text" wire:model.defer="nik_identity" id="nik_identity" class="w-full border rounded p-2">
            @error('nik_identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="identity">Upload Identitas (jpg/png/pdf)</label>
            <input type="file" wire:model="identity" id="identity" class="w-full border rounded p-2">
            @error('identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($identity)
                <p class="text-green-600 mt-1">Berkas terunggah: {{ $identity->getClientOriginalName() }}</p>
            @endif
        </div>

        <div>
            <label for="payment_method">Metode Pembayaran</label>
            <select wire:model.defer="payment_method" id="payment_method" class="w-full border rounded p-2">
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="transfer">Transfer</option>
                <option value="cod">Bayar di Tempat (COD)</option>
            </select>
        </div>

        <div class="bg-gray-100 p-4 rounded mt-4">
            <p><strong>Durasi:</strong> {{ $days }} hari</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($total_price, 0, ',', '.') }}</p>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Booking Sekarang</button>
        </div>
    </form>
</div>
