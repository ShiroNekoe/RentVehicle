<div class="px-4 py-6 max-w-4xl mx-auto">
    <h2 class="text-3xl font-extrabold text-indigo-600 mb-6 border-b pb-2">Detail Booking</h2>

    <div class="bg-white shadow-xl rounded-2xl p-6 mb-6 border border-gray-100">
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $booking->vehicle->vehicle_name }}</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
            <p class="text-gray-700">🚗 <span class="font-medium">Tipe:</span> {{ ucfirst($booking->vehicle->vehicle_type) }}</p>
            <p class="text-gray-700">🛠️ <span class="font-medium">Model:</span> {{ ucfirst($booking->vehicle->vehicle_model) }}</p>
            <p class="text-gray-700">⚙️ <span class="font-medium">Transmisi:</span> {{ ucfirst($booking->vehicle->vehicle_transmission) }}</p>
            <p class="text-gray-700">🔢 <span class="font-medium">Nomor Plat:</span> {{ $booking->vehicle->number_plate }}</p>
            <p class="text-gray-700 col-span-2">📍 <span class="font-medium">Titik Jemput:</span> 
                <span class="text-gray-900 font-semibold">
                    {{ $booking->pickup_location ?? 'Tidak ada titik jemput' }}
                </span>
            </p>
        </div>

        <div class="mt-6 border-t pt-4 space-y-2">
            <h4 class="text-lg font-semibold text-gray-800">Status Booking</h4>
            <p class="text-gray-600">{{ ucfirst($booking->booking_status) }}</p>

            <h4 class="text-lg font-semibold text-gray-800 mt-2">Status Pembayaran</h4>
            <p class="text-lg">
                @if ($booking->payment_status == 'paid')
                    <span class="text-green-600 font-bold">✅ LUNAS</span>
                @elseif ($booking->payment_status == 'pending')
                    <span class="text-yellow-500 font-bold">⏳ MENUNGGU KONFIRMASI ADMIN</span>
                @elseif ($booking->payment_status == 'failed' || $booking->payment_status == 'expired')
                    <span class="text-red-500 font-bold">❌ GAGAL / KADALUARSA</span>
                @else
                    <span class="text-gray-500">Status tidak diketahui</span>
                @endif
            </p>

            <h4 class="text-lg font-semibold text-gray-800 mt-2">Tanggal Booking</h4>
            <p class="text-gray-600">{{ $booking->created_at->format('d M Y H:i') }}</p>

            <h4 class="text-lg font-semibold text-gray-800 mt-2">Total Pembayaran</h4>
            <p class="text-indigo-700 font-bold text-lg">Rp {{ number_format($booking->vehicle->price, 0, ',', '.') }}</p>
        </div>

        {{-- Tombol Cancel Booking --}}
        @if ($booking->booking_status !== 'completed' && $booking->booking_status !== 'cancelled')
            <form id="cancelBookingForm" action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="mt-6">
                @csrf
                @method('PUT')
                <button type="button"
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-medium transition"
                    onclick="confirmCancel()">
                    ❌ Batalkan Booking
                </button>
            </form>
        @endif

        {{-- Tombol Review --}}
        @if ($booking->booking_status === 'completed' && $booking->payment_status === 'paid' && !$booking->review)
            <a href="{{ route('user.review', $booking->id) }}"
               class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                ✍️ Beri Ulasan
            </a>
        @elseif ($booking->review)
            <p class="mt-4 text-green-600 font-semibold">✅ Anda sudah memberikan ulasan pada booking ini.</p>
        @endif

        {{-- Tombol Perpanjang Booking --}}
        @if ($booking->booking_status === 'completed' && $booking->payment_status === 'paid')
            <a href="{{ route('booking.extend.form', $booking->id) }}"
               class="inline-block mt-4 bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg font-medium transition">
                ⏱️ Perpanjang Booking
            </a>
        @endif

        {{-- Tombol Kembali --}}
        <a href="{{ route('user.history') }}"
           class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium border border-indigo-500 px-5 py-2 rounded-lg transition">
            ⬅️ Kembali ke Dashboard
        </a>
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmCancel() {
        Swal.fire({
            title: 'Yakin ingin membatalkan booking?',
            text: "Booking Anda akan dibatalkan dan diarahkan ke admin.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelBookingForm').submit();
            }
        });
    }
</script>
