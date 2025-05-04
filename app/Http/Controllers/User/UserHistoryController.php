<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil 5 kendaraan terbaru
        $vehicles = Vehicle::latest()->take(15)->get();

        // Ambil riwayat booking user
        $bookings = Booking::where('id_user', $user->id)->latest()->take(15)->get();

        return view('user.history', compact('user', 'vehicles', 'bookings'));

    }
}
