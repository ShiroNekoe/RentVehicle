<form wire:submit.prevent="submitBooking" enctype="multipart/form-data">
    <input type="date" wire:model="start_date">
    <input type="date" wire:model="end_date">

    <select wire:model="id_driver">
        <option value="">Tanpa Supir</option>
        @foreach($drivers as $driver)
            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
        @endforeach
    </select>

    <input type="text" wire:model="phone_person" placeholder="Nomor HP Pribadi">
    <input type="text" wire:model="phone_security" placeholder="Nomor HP Darurat">
    <input type="text" wire:model="nik_identity" placeholder="NIK">
    <input type="file" wire:model="identity">
    <input type="text" wire:model="pickup_location" placeholder="Lokasi Penjemputan">

    <p>Total Hari: {{ $days }} hari</p>
    <p>Total Harga: Rp {{ number_format($total_price, 0, ',', '.') }}</p>

    <button type="submit">Booking Sekarang</button>
</form>
@if (session()->has('snap_token'))
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        window.snap.pay("{{ session('snap_token') }}", {
            onSuccess: function(result) {
                window.location.href = "/booking/success"; // redirect sesuai kebutuhan
            },
            onPending: function(result) {
                console.log("Pending", result);
            },
            onError: function(result) {
                console.log("Error", result);
            }
        });
    </script>
@endif
