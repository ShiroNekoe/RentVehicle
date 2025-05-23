<div class="container mx-auto p-6 space-y-6">
    <form wire:submit.prevent="submitBooking" enctype="multipart/form-data" class="space-y-6">

        <!-- Informasi Waktu -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tanggal Mulai -->
            <div>
                <label for="start_date" class="font-semibold">Tanggal Mulai</label>
                <input id="start_date" type="date" wire:model.defer="start_date" class="w-full border p-2 mt-1">
                @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label for="end_date" class="font-semibold">Tanggal Selesai</label>
                <input id="end_date" type="date" wire:model.defer="end_date" class="w-full border p-2 mt-1">
                @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Jam -->
            <div>
                <label for="start_time" class="font-semibold">Jam Pengambilan</label>
                <input id="start_time" type="time" wire:model.defer="start_time" class="w-full border p-2 mt-1">
                @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Kontak & Identitas -->
        <div class="space-y-4">
            <!-- No HP -->
            <div>
                <label for="phone_person" class="font-semibold">No. HP Anda</label>
                <input id="phone_person" type="text" wire:model.defer="phone_person" class="w-full border p-2 mt-1">
                @error('phone_person') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- No HP Darurat -->
            <div>
                <label for="phone_security" class="font-semibold">No. HP Darurat</label>
                <input id="phone_security" type="text" wire:model.defer="phone_security" class="w-full border p-2 mt-1">
                @error('phone_security') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- NIK -->
            <div>
                <label for="nik_identity" class="font-semibold">NIK (16 Digit)</label>
                <input id="nik_identity" type="text" wire:model.defer="nik_identity" class="w-full border p-2 mt-1">
                @error('nik_identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Upload Identitas -->
            <div>
                <label for="identity" class="font-semibold">Upload Identitas (KTP / SIM - JPG, PNG, PDF)</label>
                <input id="identity" type="file" wire:model="identity" accept=".jpg,.jpeg,.png,.pdf" class="w-full border p-2 mt-1">
                @error('identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Lokasi Jemput & Metode Pembayaran -->
        <div class="space-y-4">
            <!-- Lokasi Jemput -->
            <div>
                <label for="pickup_location" class="font-semibold">Lokasi Jemput</label>
                <select id="pickup_location" wire:model="pickup_location" class="w-full border p-2 mt-1">
                    <option value="">Pilih Lokasi Jemput</option>
                    <option value="default">Lokasi Rental</option>
                    <option value="other">Lainnya (Isi Lokasi)</option>
                </select>
                @error('pickup_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Menampilkan input text field jika memilih "Lainnya" -->
            @if($pickup_location === 'other')
                <div>
                    <label for="other_pickup_location" class="font-semibold">Masukkan Lokasi Lainnya</label>
                    <input id="other_pickup_location" type="text" wire:model="other_pickup_location" class="w-full border p-2 mt-1">
                    @error('other_pickup_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif

            <!-- Metode Pembayaran -->
            <div>
                <label for="payment_method" class="font-semibold">Metode Pembayaran</label>
                <select id="payment_method" wire:model.defer="payment_method" class="w-full border p-2 mt-1">
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="transfer">Transfer</option>
                    <option value="cod">COD</option>
                </select>
                @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Opsi Driver -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="use_driver" class="mr-2">
                    Tambahkan Driver (Rp125.000)
                </label>
            </div>
        </div>

        <!-- Ringkasan Pemesanan -->
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

        <!-- Tombol Submit -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-warning px-4 py-2 rounded hover:bg-warning">
                Booking Sekarang
            </button>
        </div>

        <!-- Pesan Error -->
        @if (session()->has('error'))
            <div class="mt-2 text-red-500">
                {{ session('error') }}
            </div>
        @endif
    </form>
</div>
