<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // GET /api/reviews
    public function index()
    {
        $reviews = Review::with(['vehicle', 'user'])->latest()->get();
        return response()->json($reviews);
    }

    // GET /api/reviews/{id}
    public function show($id)
    {
        $review = Review::with(['vehicle', 'user'])->findOrFail($id);
        return response()->json($review);
    }

    // POST /api/reviews
    public function store(Request $request, Booking $booking)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Pastikan booking milik user yang login
        if ($booking->id_user !== $user->id) {
            return response()->json(['error' => 'Unauthorized or invalid booking'], 403);
        }

        $request->validate([
            'rating' => 'required|in:1,2,3,4,5',
        ]);

        $review = Review::create([
            'id_booking' => $booking->id,
            'id_user' => $user->id,
            'rating' => $request->rating,
            'review' => $request->review,
            'review_date' => now(),
        ]);
                  
        return response()->json([
            'status' => 'success',
            'data' => $review,
        ], 201);
    }
}
