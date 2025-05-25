<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Booking $booking)
    {
        // Pastikan booking milik user yang login
        if ($booking->user_id || $booking->payment_status !== 'paid' || $booking->booking_status !== 'completed') {
            return redirect()->route('user.history')->with('error', 'Akses tidak valid untuk beri ulasan.');
        }

        // Cek apakah sudah pernah memberi ulasan
        if ($booking->review) {
            return redirect()->route('user.history')->with('info', 'Anda sudah memberikan ulasan untuk booking ini.');
        }

        return view('user.review', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        // Pastikan booking terkait milik pengguna yang sedang login
        if ($booking->user_id || $booking->payment_status !== 'paid' || $booking->booking_status !== 'completed') {
            return redirect()->route('user.history')->with('error', 'Akses tidak valid untuk beri ulasan.');
        }

        // Validasi input rating dan review
        $request->validate([
            'rating' => 'required|in:1,2,3,4,5',
            'review' => 'nullable|string|max:500',
        ]);

        // Menyimpan review
        Review::create([
            'id_booking' => $booking->id,
             'id_user' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->review,
            'review_date' => now(),
        ]);

        return redirect()->route('user.history')->with('success', 'Ulasan berhasil dikirim.');
    }

    
}
