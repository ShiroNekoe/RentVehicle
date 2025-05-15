<div>
    <form wire:submit.prevent="submitBooking" enctype="multipart/form-data">

        <!-- Tanggal Mulai -->
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
            <input type="date" id="start_date" wire:model="start_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Tanggal Selesai -->
        <div class="mb-4">
            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
            <input type="date" id="end_date" wire:model="end_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Pilih Driver -->
        <div class="mb-4">
            <label for="id_driver" class="block text-sm font-medium text-gray-700">Pilih Supir (Opsional)</label>
            <select wire:model="id_driver" id="id_driver" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Tanpa Supir --</option>
                @foreach ($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }} </option>
                @endforeach
            </select>
        </div>

        <!-- Telepon Person -->
        <div class="mb-4">
            <label for="phone_person" class="block text-sm font-medium text-gray-700">Telepon Anda</label>
            <input type="text" id="phone_person" wire:model="phone_person" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Telepon Keamanan -->
        <div class="mb-4">
            <label for="phone_security" class="block text-sm font-medium text-gray-700">Telepon Keamanan</label>
            <input type="text" id="phone_security" wire:model="phone_security" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- NIK Identitas -->
        <div class="mb-4">
            <label for="nik_identity" class="block text-sm font-medium text-gray-700">NIK Identitas</label>
            <input type="text" id="nik_identity" wire:model="nik_identity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Titik Jemput -->
         <div class="mb-4">
         <label for="pickup_location" class="block text-sm font-medium text-gray-700">Titik Jemput</label>
          <input type="text" id="pickup_location" wire:model="pickup_location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan alamat titik jemput">
         </div>

        <!-- Upload Identitas -->
        <div class="mb-4">
            <label for="identity" class="block text-sm font-medium text-gray-700">Identitas</label>
            <input type="file" id="identity" wire:model="identity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('identity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Durasi Sewa -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Durasi Sewa:</label>
            @if ($start_date && $end_date && $days > 0)
                <p class="text-base">{{ $days }} hari</p>
            @else
                <p class="text-gray-500">Tentukan tanggal mulai dan selesai.</p>
            @endif
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Total Harga:</label>
            <p class="text-lg font-semibold text-gray-800">
                Rp{{ number_format($vehicle->price * $days, 0, ',', '.') }}
            </p>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select wire:model="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="transfer">Transfer Bank</option>
                <option value="midtrans">Payment Gateway (Midtrans)</option>
            </select>
        </div>

        <!-- Pembayaran Transfer Bank -->
        @if ($payment_method === 'transfer')
            <a href="{{ route('transfer.confirmation', ['amount' => $vehicle->price * $days]) }}"
               class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                Lanjut ke Konfirmasi Transfer
            </a>
        @endif

        <!-- Pembayaran Midtrans -->
        @if (session()->has('snap_token'))
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
            <script type="text/javascript">
                window.onload = function () {
                    snap.pay('{{ session('snap_token') }}', {
                        onSuccess: function(result){
                            console.log('Pembayaran sukses:', result);
                            window.location.href = "/booking/success";
                        },
                        onPending: function(result){
                            console.log('Menunggu pembayaran:', result);
                            window.location.href = "/booking/pending";
                        },
                        onError: function(result){
                            console.log('Pembayaran error:', result);
                            window.location.href = "/booking/failed";
                        },
                        onClose: function(){
                            alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
                        }
                    });
                };
            </script>
        @endif


        <!-- Tombol Submit -->
        <div class="mb-4">
            @if ($payment_method === 'midtrans' && session()->has('snap_token'))
                <p class="text-green-600">Sedang memuat pembayaran...</p>
            @else
                <button type="submit" style="text-black">
                    {{ $payment_method === 'midtrans' ? 'Bayar dengan Midtrans' : 'Booking' }}
                </button>
            @endif
        </div>

    </form>
</div>
