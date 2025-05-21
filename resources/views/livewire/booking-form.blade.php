<div>
    <form wire:submit.prevent="submitBooking" enctype="multipart/form-data" class="space-y-4">

        {{-- Informasi Waktu --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Tanggal Mulai</label>
                <input type="date" wire:model.defer="start_date" class="w-full border p-2">
                @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Jam Mulai</label>
                <input type="time" wire:model.defer="start_time" class="w-full border p-2">
                @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Tanggal Selesai</label>
                <input type="date" wire:model.defer="end_date" class="w-full border p-2">
                @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Jam Selesai</label>
                <input type="time" wire:model.defer="end_time" class="w-full border p-2">
                @error('end_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Kontak & Identitas --}}
        <div>
            <label>No. HP Anda</label>
            <input type="text" wire:model.defer="phone_person" class="w-full border p-2">
            @error('phone_person') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label No. HP Darurat</label>
            <input type="text" wire:model.defer="phone_security" class="w-full border p-2">
            @error('phone_security') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>NIK (16 Digit)</label>
            <input type="text" wire:model.defer="nik_identity" class="w-full border p-2">
            @error('nik_identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Upload Identitas (KTP / SIM - JPG, PNG, PDF)</label>
            <input type="file" wire:model="identity" class="w-full border p-2">
            @error('identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Lokasi Jemput & Metode Pembayaran --}}
        <div>
            <label>Lokasi Jemput (Opsional)</label>
            <input type="text" wire:model.defer="pickup_location" class="w-full border p-2">
            @error('pickup_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Metode Pembayaran</label>
            <select wire:model.defer="payment_method" class="w-full border p-2">
                <option value="">-- Pilih --</option>
                <option value="transfer">Transfer</option>
                <option value="cod">COD</option>
            </select>
            @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Opsi Driver --}}
        <div>
            <label>
                <input type="checkbox" wire:model="use_driver" class="mr-2"> Tambahkan Driver (Rp125.000)
            </label>
        </div>

        {{-- STRUK PEMESANAN --}}
        <div class="border p-4 mt-4 bg-gray-100 rounded">
            <h2 class="text-lg font-semibold mb-2">Ringkasan Pemesanan</h2>
            <p><strong>Nama Kendaraan:</strong> {{ $vehicle->name }}</p>
            <p><strong>Durasi:</strong> {{ $days }} hari</p>
            <p><strong>Harga per Hari:</strong> Rp{{ number_format($vehicle->price, 0, ',', '.') }}</p>

            @if ($use_driver)
                <p><strong>Biaya Driver:</strong> Rp125.000</p>
            @endif

            <hr class="my-2">
            <p class="text-xl"><strong>Total:</strong> Rp{{ number_format($total_price, 0, ',', '.') }}</p>

            @if (!$isVehicleAvailable)
                <p class="text-red-600 text-sm mt-2">* Kendaraan tidak tersedia di tanggal yang dipilih.</p>
            @endif
        </div>

        {{-- Tombol Submit --}}
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Booking Sekarang
            </button>
        </div>

        {{-- Pesan Error --}}
        @if (session()->has('error'))
            <div class="mt-2 text-red-500">
                {{ session('error') }}
            </div>
        @endif
    </form>
</div>
