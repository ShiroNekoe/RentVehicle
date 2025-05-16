<div class="px-4 py-6 max-w-4xl mx-auto">
    <h2 class="text-3xl font-extrabold text-indigo-600 mb-6 border-b pb-2">📝 Detail Booking</h2>

    <div class="bg-white shadow-xl rounded-2xl p-6 mb-6 border border-gray-100 space-y-4">
        {{-- Nama Kendaraan --}}
        <h3 class="text-2xl font-bold text-gray-800">{{ $booking->vehicle->vehicle_name }}</h3>

        {{-- Informasi Kendaraan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-gray-700">
            <p>🚗 <span class="font-medium">Tipe:</span> {{ ucfirst($booking->vehicle->vehicle_type) }}</p>
            <p>🛠️ <span class="font-medium">Model:</span> {{ ucfirst($booking->vehicle->vehicle_model) }}</p>
            <p>⚙️ <span class="font-medium">Transmisi:</span> {{ ucfirst($booking->vehicle->vehicle_transmission) }}</p>
            <p>🔢 <span class="font-medium">Nomor Plat:</span> {{ $booking->vehicle->number_plate }}</p>
            <p class="md:col-span-2">📍 <span class="font-medium">Titik Jemput:</span> 
                <span class="font-semibold text-gray-900">
                    {{ $booking->pickup_location ?? 'Tidak ada titik jemput' }}
                </span>
            </p>
        </div>

        {{-- Status dan Waktu --}}
        <div class="pt-4 border-t space-y-2 text-gray-800">
            <div>
                <h4 class="text-lg font-semibold">Status Booking</h4>
                <p class="text-gray-600">{{ ucfirst($booking->booking_status) }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold">Status Pembayaran</h4>
                <p class="text-lg">
                    @if ($booking->payment_status == 'paid')
                        <span class="text-green-600 font-bold">✅ LUNAS</span>
                    @elseif ($booking->payment_status == 'pending')
                        <span class="text-yellow-500 font-bold">⏳ MENUNGGU KONFIRMASI ADMIN</span>
                    @elseif (in_array($booking->payment_status, ['failed', 'expired']))
                        <span class="text-red-500 font-bold">❌ GAGAL / KADALUARSA</span>
                    @else
                        <span class="text-gray-500">Status tidak diketahui</span>
                    @endif
                </p>
            </div>

            <div>
                <h4 class="text-lg font-semibold">Tanggal Booking</h4>
                <p class="text-gray-600">{{ $booking->created_at->format('d M Y H:i') }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold">Total Pembayaran</h4>
                <p class="text-indigo-700 font-bold text-lg">Rp {{ number_format($booking->vehicle->price, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="pt-4 border-t grid gap-3 md:grid-cols-2 mt-4">
           {{-- Tombol Lihat Invoice --}}
            <a href="{{ route('invoice.booking', $booking->id) }}"
            class="inline-block mt-4 bg-indigo-500 hover:bg-indigo-600 text-white px-5 py-2 rounded-lg font-medium transition">
                🧾 Lihat Invoice
            </a>


            {{-- Tombol Cancel --}}
            @if (!in_array($booking->booking_status, ['completed', 'cancelled']))
                <form id="cancelBookingForm" action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="button"
                            class="bg-red-600 hover:bg-red-700 text-white w-full px-5 py-2 rounded-lg font-medium transition"
                            onclick="confirmCancel()">
                        ❌ Batalkan Booking
                    </button>
                </form>
            @endif

            {{-- Tombol Ulasan --}}
            @if ($booking->booking_status === 'completed' && $booking->payment_status === 'paid' && !$booking->review)
                <a href="{{ route('user.review', $booking->id) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-center px-5 py-2 rounded-lg font-medium transition">
                    ✍️ Beri Ulasan
                </a>
            @elseif ($booking->review)
                <p class="text-green-600 font-semibold col-span-2">✅ Anda sudah memberikan ulasan.</p>
            @endif

            {{-- Tombol Perpanjang --}}
            @if ($booking->booking_status === 'completed' && $booking->payment_status === 'paid')
                <a href="{{ url('/booking/' . $booking->id . '/extend') }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white text-center px-5 py-2 rounded-lg font-medium transition">
                    ⏱️ Perpanjang Booking
                </a>
            @endif
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-6">
            <a href="{{ route('user.history') }}"
               class="inline-block text-indigo-600 hover:text-indigo-800 border border-indigo-500 px-5 py-2 rounded-lg font-medium transition">
                ⬅️ Kembali ke Riwayat
            </a>
        </div>
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
