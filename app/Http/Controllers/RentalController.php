<?php

namespace App\Http\Controllers;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $vehicles = Vehicle::latest()->take(9)->get(); // ambil 9 mobil terbaru atau terbanyak dibooking nantinya
        $bookings = Booking::with('vehicle')->where('id_user', $user->id)->latest()->get();

        return view('user.dashboard', compact('user', 'vehicles', 'bookings'));
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }
}
