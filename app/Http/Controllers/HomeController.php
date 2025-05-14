<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Review;

class HomeController extends Controller
{
   public function index()
{
    // Ambil kendaraan populer dengan relasi galeri dan hitung jumlah booking
    $popularVehicles = Vehicle::with(['galleries']) // Tambahkan relasi galleries
        ->withCount('bookings') // Hitung jumlah booking
        ->orderBy('bookings_count', 'desc') // Urutkan dari yang paling sering di-booking
        ->take(6) // Ambil 6 teratas
        ->get();

    // Ambil review kendaraan beserta user & vehicle-nya
    $reviews = Review::with('vehicle', 'user')->get();

    return view('welcome', compact('popularVehicles', 'reviews'));
}


    public function showReviews()
{
    // Mengambil semua review dengan relasi kendaraan dan pengguna
    $reviews = Review::with(['vehicle', 'user'])->get();
    
    return view('user.reviews', compact('reviews'));
}
}
