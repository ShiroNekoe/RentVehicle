@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-center text-gray-800 my-10">Your Booking Details</h1>

<div class="px-4 py-6 max-w-4xl mx-auto">
    <!-- Vehicle Image -->
    <div class="flex justify-center mb-6">

    <img src="{{ Storage::url(optional($booking->vehicle->galleries->first())->image_path ?? 'default.jpg') }}" class="object-cover h-64 w-80" alt="Vehicle Image">

    </div>

    <!-- Vehicle Name -->
    <h3 class="text-2xl font-bold text-gray-800 text-center mb-4">{{ $booking->vehicle->vehicle_name }}</h3>

    <!-- Vehicle Information -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border border-[#316783] space-y-4">
        <!-- Grid for vehicle details displayed in 3-left 3-right -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 text-center">
            <div>
                <p><span class="font-medium">Type:</span> {{ ucfirst($booking->vehicle->vehicle_type) }}</p>
                <p><span class="font-medium">Model:</span> {{ ucfirst($booking->vehicle->vehicle_model) }}</p>
                <p><span class="font-medium">Brand:</span> {{ ucfirst($booking->vehicle->vehicle_brand) }}</p>
            </div>

            <div>
                <p><span class="font-medium">Transmission:</span> {{ ucfirst($booking->vehicle->vehicle_transmission) }}</p>
                <p><span class="font-medium">Seats:</span> {{ ucfirst($booking->vehicle->seat) }}</p>
                <p><span class="font-medium">License Plate:</span> {{ $booking->vehicle->number_plate }}</p>
            </div>
        </div>
    </div>

    <!-- Booking Details Information -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border border-[#316783] space-y-4">
        <h4 class="text- text-center font-semibold">Booking Details Information</h4>
        <div class="space-y-2">
            <p><span class="font-medium">Rental Start Date:</span> {{$booking->start_date}} </p>
            <p><span class="font-medium">End Date:</span> {{$booking->end_date}}</p>
            @php
                use Carbon\Carbon;
                $duration = Carbon::parse($booking->start_date)->diffInDays(Carbon::parse($booking->end_date));
            @endphp
            <p><span class="font-medium">Booking Duration:</span> {{ $duration }} days</p>
          <p><span class="font-medium">Driver:</span> {{ $booking->driver?->name ?? 'No driver assigned' }}</p>
            <p><span class="font-medium">Pick-up Location:</span> {{ $booking->pickup_location ?? 'No pick-up location' }} </p>            
        </div>
    </div>

    <!-- Status and Payment -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border border-[#316783] space-y-4">
        <!-- Booking Status (left and right) -->
        <div class="flex justify-between items-center space-x-4">
            <div class="flex-1">
                <h4 class="text-lg font-semibold">Booking Status</h4>
            </div>
            <div class="flex-1 text-right">
                <p class="text-gray-600">{{ ucfirst($booking->booking_status) }}</p>
            </div>
        </div>

        <!-- Payment Status (left and right) -->
        <div class="flex justify-between items-center space-x-4">
            <div class="flex-1">
                <h4 class="text-lg font-semibold">Payment Status</h4>
            </div>
            <div class="flex-1 text-right">
                <p class="text-lg">
                    @if ($booking->payment_status == 'paid')
                        <span class="text-green-600 font-bold">✅ PAID</span>
                    @elseif ($booking->payment_status == 'pending')
                        <span class="text-yellow-500 font-bold">⏳ WAITING FOR ADMIN CONFIRMATION</span>
                    @elseif (in_array($booking->payment_status, ['failed', 'expired']))
                        <span class="text-red-500 font-bold">❌ FAILED / EXPIRED</span>
                    @else
                        <span class="text-gray-500">Status unknown</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Booking Date (left and right) -->
        <div class="flex justify-between items-center space-x-4">
            <div class="flex-1">
                <h4 class="text-lg font-semibold">Booking Date</h4>
            </div>
            <div class="flex-1 text-right">
                <p class="text-gray-600">{{ $booking->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Total Payment (left and right) -->
        <div class="flex justify-between items-center space-x-4">
            <div class="flex-1">
                <h4 class="text-lg font-semibold">Total Payment</h4>
            </div>
            <div class="flex-1 text-right">
                <p class="text-[#316783] font-bold text-lg">Rp {{ number_format($booking->booking_price, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="flex justify-between items-center space-x-4 mt-4">
            <div class="flex-1">
                <p class="text-lg font-semibold">Invoice:</p> 
            </div>
            <a href="{{ route('invoice.booking', $booking->id) }}" class="flex items-center text-gray-400 hover:text-[#1a4e65] transition duration-300 ease-in-out">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12h4m-2 2v4m2-4h-6V7h6V3H7v4h6v6H7v4h10z" />
                </svg>
                <span class="font-semibold">View Invoice</span>
            </a>
        </div>
    </div>

{{-- Action Buttons --}}
<div class="pt-4 border-t grid gap-3 mt-4">
    <div class="flex justify-between items-center">
        {{-- Cancel Button --}}
        @if (!in_array($booking->booking_status, ['completed', 'cancelled']))
            <form id="cancelBookingForm" action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="button"
                        class="bg-red-600 hover:bg-red-700 text-white w-full md:w-auto px-5 py-2 rounded-lg font-medium transition"
                        onclick="confirmCancel()">
                    ❌ Cancel Booking
                </button>
            </form>
        @endif

        {{-- Transfer Confirmation Button --}}
       @if (
    $booking->payment &&
    $booking->payment->payment_status === 'pending' &&
    !$isDeadlinePassed &&
    $booking->payment->payment_method === 'transfer' &&
    is_null($booking->payment->transfer_to)
)
    <a href="{{ route('pages.transfer-confirmation', $booking->id) }}"
        class="bg-purple-600 hover:bg-purple-700 text-white text-center px-5 py-2 rounded-lg font-medium transition">
        💳 Confirm Transfer
    </a>
@endif

        {{-- Review Button --}}
        @if ($booking->booking_status === 'completed' && $booking->payment_status === 'paid' && !$booking->review)
            <a href="{{ route('user.review', $booking->id) }} "
               class="bg-blue-600 hover:bg-blue-700 text-white text-center px-5 py-2 rounded-lg font-medium transition">
                ✍️ Give Review
            </a>
        @elseif ($booking->review)
            <p class="text-green-600 text-center font-bold">✅ You have already given a review.</p>
        @endif

        {{-- Extend Booking Button --}}
        @if ($booking->payment_status === 'paid' && $booking->booking_status !== 'completed')
            <a href="{{ route('extend.booking', ['booking' => $booking->id]) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white text-center px-5 py-2 rounded-lg font-medium transition">
                ⏱️ Extend Booking
            </a>
        @endif



        </div>

        

    {{-- Back Button --}}
    <div class="flex justify-center mt-6">
        <a href="{{ route('user.history') }}"
           class="inline-block text-indigo-600 hover:text-indigo-800 border border-indigo-500 px-5 py-2 rounded-lg font-medium transition">
            ⬅️ Back to History
        </a>
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmCancel() {
        Swal.fire({
            title: 'Are you sure you want to cancel this booking?',
            text: "Your booking will be cancelled and directed to admin.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, cancel',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelBookingForm').submit();
            }
        });
    }
</script>
@endsection
