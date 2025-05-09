@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Beri Ulasan untuk {{ $booking->vehicle->vehicle_name }}</h2>

    <form action="{{ route('booking.review.submit', $booking->id) }}" method="POST">
        @csrf

        <label class="block mb-2 text-lg">Rating</label>
        <select name="rating" class="select select-bordered w-full" required>
            <option value="">Pilih Rating</option>
            @foreach ([1,2,3,4,5] as $star)
                <option value="{{ $star }}">{{ $star }} Bintang</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-4">Kirim Ulasan</button>
    </form>
</div>
@endsection
