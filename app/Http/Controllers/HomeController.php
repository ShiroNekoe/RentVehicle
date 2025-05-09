<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil kendaraan populer berdasarkan jumlah booking terbanyak
        $popularVehicles = Vehicle::withCount('bookings') // Menghitung jumlah booking
            ->orderBy('bookings_count', 'desc')  // Urutkan berdasarkan jumlah booking
            ->take(6)  // Ambil 6 kendaraan populer
            ->get();

            $reviews = Review::with('vehicle', 'user')->get();

        // Kirim data kendaraan populer ke view
        return view('welcome', compact('popularVehicles','reviews'));
    }

    public function showReviews()
{
    // Mengambil semua review dengan relasi kendaraan dan pengguna
    $reviews = Review::with(['vehicle', 'user'])->get();
    
    return view('user.reviews', compact('reviews'));
}
}
