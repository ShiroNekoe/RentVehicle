<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // GET /api/bookings
    public function index()
    {
        $bookings = Booking::with(['vehicle'])->where('id_user', Auth::id())->get();
        return response()->json($bookings);
    }

    // POST /api/bookings
   public function store(Request $request)
{
    $validated = $request->validate([
        'id_vehicle' => 'required|exists:vehicles,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'use_driver' => 'required|boolean',
        'booking_price' => 'required|numeric',
        'phone_security' => 'required|numeric|digits_between:12,15',
        'phone_person' => 'required|numeric|digits_between:12,15',
        'nik_identity' => 'required|numeric|digits:16',
        'identity' => 'required|file|mimes:jpg,png,pdf|max:10240',
        'pickup_location' => 'nullable|string|max:255',
        'payment_method' => 'required|in:transfer,cod',
        'return_option' => 'required|in:showroom,other',
    ]);

    // Simpan file identity
    $identityPath = $request->file('identity')->store('identities', 'public');

    $booking = Booking::create([
        'id_user' => Auth::id(),
        'id_vehicle' => $validated['id_vehicle'],
        'start_date' => $validated['start_date'],
        'end_date' => $validated['end_date'],
        'use_driver' => $validated['use_driver'],
        'booking_price' => $validated['booking_price'],
        'phone_security' => $validated['phone_security'],
        'phone_person' => $validated['phone_person'],
        'nik_identity' => $validated['nik_identity'],
        'identity' => $identityPath,
        'pickup_location' => $validated['pickup_location'] ?? null,
        'payment_method' => $validated['payment_method'],
        'return_option' => $validated['return_option'],
        'payment_status' => 'pending',
        'booking_status' => 'ongoing',
    ]);

    return response()->json([
        'message' => 'Booking berhasil dibuat',
        'data' => $booking
    ], 201);
}


    // GET /api/bookings/{id}
    public function show($id)
    {
        $booking = Booking::with('vehicle')->where('id_user', Auth::id())->findOrFail($id);
        return response()->json($booking);
    }
}
