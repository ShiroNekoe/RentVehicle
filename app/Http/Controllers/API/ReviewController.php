<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_vehicle' => 'required|exists:vehicles,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = Review::create([
            'id_user' => Auth::id(),
            'id_vehicle' => $validated['id_vehicle'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'review_date' => now(),
        ]);

        return response()->json(['message' => 'Review berhasil dikirim', 'data' => $review], 201);
    }
}
