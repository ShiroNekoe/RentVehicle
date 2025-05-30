@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-8 bg-white shadow-lg rounded-xl">
    <h2 class="text-3xl text-center font-extrabold mb-6 text-gray-900">Leave a Review for {{ $booking->vehicle->vehicle_name }}</h2>

    <form action="{{ route('booking.review.submit', $booking->id) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="rating" class="block mb-2 text-lg font-semibold text-gray-700">Rating</label>
            <select name="rating" id="rating" class="select select-bordered w-full text-gray-700" required>
                <option value="" disabled selected>Select Rating</option>
                @foreach ([1,2,3,4,5] as $star)
                    <option value="{{ $star }}">{{ $star }} Star{{ $star > 1 ? 's' : '' }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning text-white w-full py-3 text-lg font-semibold hover:scale-105 transition-transform duration-200">
            Submit Review
        </button>
    </form>
</div>
@endsection
