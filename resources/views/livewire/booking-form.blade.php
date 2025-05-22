<div>
    <form wire:submit.prevent="submitBooking" enctype="multipart/form-data" class="space-y-4">

        {{-- Informasi Waktu --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date">Tanggal Mulai</label>
                <input id="start_date" type="date" wire:model.defer="start_date" class="w-full border p-2">
                @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="start_time">Jam pengambilan dan pengembalian</label>
                <input id="start_time" type="time" wire:model.defer="start_time" class="w-full border p-2">
                @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="end_date">Tanggal Selesai</label>
                <input id="end_date" type="date" wire:model.defer="end_date" class="w-full border p-2">
                @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


        {{-- Kontak & Identitas --}}
        <div>
            <label for="phone_person">No. HP Anda</label>
            <input id="phone_person" type="text" wire:model.defer="phone_person" class="w-full border p-2">
            @error('phone_person') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="phone_security">No. HP Darurat</label>
            <input id="phone_security" type="text" wire:model.defer="phone_security" class="w-full border p-2">
            @error('phone_security') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="nik_identity">NIK (16 Digit)</label>
            <input id="nik_identity" type="text" wire:model.defer="nik_identity" class="w-full border p-2">
            @error('nik_identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="identity">Upload Identitas (KTP / SIM - JPG, PNG, PDF)</label>
            <input id="identity" type="file" wire:model="identity" accept=".jpg,.jpeg,.png,.pdf" class="w-full border p-2">
            @error('identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Lokasi Jemput & Metode Pembayaran --}}
        <div>
            <label for="pickup_location">Lokasi Jemput (Opsional)</label>
            <input id="pickup_location" type="text" wire:model.defer="pickup_location" class="w-full border p-2">
            @error('pickup_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label>
                <input type="checkbox" wire:model="return_showroom" value="1"> Ke Showroom
            </label>

            <label>
                Lokasi Lain:
                <input type="text" wire:model.defer="return_location" placeholder="Isi lokasi pengembalian">
            </label>
        </div>


        <div>
            <label for="payment_method">Metode Pembayaran</label>
            <select id="payment_method" wire:model.defer="payment_method" class="w-full border p-2">
                <option value="">-- Pilih --</option>
                <option value="transfer">Transfer</option>
                <option value="cod">COD</option>
            </select>
            @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Opsi Driver --}}
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="use_driver" class="mr-2">
                Tambahkan Driver (Rp125.000)
            </label>
        </div>

        {{-- STRUK PEMESANAN --}}
        <div class="border p-4 mt-4 bg-gray-100 rounded">
            <h2 class="text-lg font-semibold mb-2">Ringkasan Pemesanan</h2>
            <p><strong>Nama Kendaraan:</strong> {{ $vehicle->vehicle_name }}</p>
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
