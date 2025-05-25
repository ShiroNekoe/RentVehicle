<div>
    @if (session()->has('error'))
        <div class="p-3 mb-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="submitBooking" class="space-y-6">
        <div>
            <label class="block font-semibold">Tanggal</label>
            <div class="flex gap-2">
                <input type="date" wire:model="start_date" class="input input-bordered w-1/2">
                
            </div>
            @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
           
        </div>

        <div>
            <label class="block font-semibold">Tanggal selesai</label>
            <div class="flex gap-2">
                <input type="date" wire:model="end_date" class="input input-bordered w-1/2">
                @error('end_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label>waktu mulai dan selesai</label>
            <input type="time" wire:model="start_time" class="input input-bordered w-1/2">
             @error('start_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Nomor HP Pribadi</label>
            <input type="text" wire:model="phone_person" class="input input-bordered w-full">
            @error('phone_person') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Nomor HP Darurat</label>
            <input type="text" wire:model="phone_security" class="input input-bordered w-full">
            @error('phone_security') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">NIK (16 digit)</label>
            <input type="text" wire:model="nik_identity" class="input input-bordered w-full">
            @error('nik_identity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Upload Identitas (jpg/png/pdf)</label>
            <input type="file" wire:model="identity" class="file-input file-input-bordered w-full" accept=".jpg,.png,.pdf">
            @error('identity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Lokasi Penjemputan (opsional)</label>
            <input type="text" wire:model="pickup_location" class="input input-bordered w-full">
            @error('pickup_location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Gunakan Driver?</label>
            <input type="checkbox" wire:model="use_driver" class="toggle toggle-primary">
            @if($use_driver)
                <div class="mt-2">
                    <label class="block">Driver dipilih otomatis (acak)</label>
                    <input type="text" value="ID Driver: {{ $id_driver }}" class="input input-bordered w-full" disabled>
                </div>
            @endif
        </div>

        <div>
            <label class="block font-semibold">Metode Pengembalian</label>
            <select wire:model="return_option" class="select select-bordered w-full">
                <option value="showroom">Kembalikan ke showroom</option>
                <option value="other">Lokasi lain</option>
            </select>
            @if($return_option === 'other')
                <input type="text" wire:model="return_location" class="input input-bordered w-full mt-2" placeholder="Lokasi pengembalian">
                @error('return_location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            @endif
        </div>

        <div>
            <label class="block font-semibold">Metode Pembayaran</label>
            <select wire:model="payment_method" class="select select-bordered w-full">
                <option value="">Pilih Metode</option>
                <option value="transfer">Transfer Bank</option>
                <option value="cod">Bayar di Tempat (COD)</option>
            </select>
            @error('payment_method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="p-4 bg-gray-100 rounded mt-4">
            <p><strong>Total Hari:</strong> {{ $days }} hari</p>
            <p><strong>Total Harga:</strong> Rp{{ number_format($total_price, 0, ',', '.') }}</p>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Booking Sekarang</button>
        </div>
    </form>
</div>
