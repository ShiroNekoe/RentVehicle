<div>
    <form wire:submit.prevent="submitBooking" enctype="multipart/form-data">
        <!-- Durasi Sewa -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Durasi Sewa:</label>
            @if ($start_date && $end_date && $days > 0)
                <p class="text-base">{{ $days }} hari</p>
            @else
                <p class="text-base text-gray-500">Silakan pilih tanggal mulai dan selesai</p>
            @endif
        </div>

        <!-- Tanggal Mulai -->
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
            <input type="date" id="start_date" wire:model="start_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Tanggal Selesai -->
        <div class="mb-4">
            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
            <input type="date" id="end_date" wire:model="end_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Pilih Driver -->
        <div class="mb-4">
            <label for="id_driver" class="block text-sm font-medium text-gray-700">Pilih Supir (Opsional)</label>
            <select wire:model="id_driver" id="id_driver" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Tanpa Supir --</option>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }} - {{ $driver->phone }}</option>
                @endforeach
            </select>
        </div>

        <!-- Telepon Keamanan -->
        <div class="mb-4">
            <label for="phone_security" class="block text-sm font-medium text-gray-700">Telepon Keamanan</label>
            <input type="text" id="phone_security" wire:model="phone_security" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- NIK Identitas -->
        <div class="mb-4">
            <label for="nik_identity" class="block text-sm font-medium text-gray-700">NIK Identitas</label>
            <input type="text" id="nik_identity" wire:model="nik_identity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Upload Identitas -->
        <div class="mb-4">
            <label for="identity" class="block text-sm font-medium text-gray-700">Identitas</label>
            <input type="file" id="identity" wire:model="identity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select wire:model="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="transfer">Transfer Bank</option>
                <option value="midtrans">Payment Gateway (Midtrans)</option>
            </select>
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Total Harga:</label>
            <p class="text-lg font-semibold">
                Rp{{ number_format($vehicle->price * $days, 0, ',', '.') }}
            </p>
        </div>

        <!-- Pembayaran Transfer Bank -->
        @if ($payment_method === 'transfer')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jumlah Transfer:</label>
                <p class="text-lg font-semibold mb-2">
                    Rp{{ number_format($vehicle->price * $days, 0, ',', '.') }}
                </p>

                <!-- Link Redirect ke Halaman Konfirmasi Transfer -->
                <a href="{{ route('transfer.confirmation', ['amount' => $vehicle->price * $days]) }}"
                   class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    Lanjut ke Konfirmasi Transfer
                </a>
            </div>
        @endif

        <!-- Pembayaran Midtrans -->
        @if ($payment_method === 'midtrans')
            <div class="mb-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                    Bayar dengan Midtrans
                </button>
            </div>
        @endif

        <!-- Tombol Submit untuk Booking -->
        <div class="mb-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                {{ $payment_method === 'midtrans' ? 'Bayar dengan Midtrans' : 'Booking' }}
            </button>
        </div>
    </form>
</div>
