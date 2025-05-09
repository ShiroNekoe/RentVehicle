<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
    
        // Mulai query builder untuk kendaraan
        $vehicleQuery = Vehicle::query();
    
        // Cek apakah ada filter
        if ($request->filled('tanggal')) {
            $vehicleQuery->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('vehicle_brand')) {
            $vehicleQuery->where('vehicle_brand', 'like', '%' . $request->brand . '%');
        }
        if ($request->filled('vehicle_model')) {
            $vehicleQuery->where('vehicle_model', 'like', '%' . $request->model . '%');
        }
        if ($request->filled('vehicle_type')) {
            $vehicleQuery->where('vehicle_type', 'like', '%' . $request->type . '%');
        }
        if ($request->filled('vehicle_name')) {
            $vehicleQuery->where('vehicle_name', 'like', '%' . $request->nama . '%');
        }
    
        // Ambil 5 kendaraan terbaru setelah filter (atau tanpa filter)
        $vehicles = $vehicleQuery->latest()->take(5)->get();
    
        // Ambil 5 riwayat booking terbaru user
        $bookings = Booking::where('id_user', $user->id)
            ->latest()
            ->take(5)
            ->get();
    
        return view('user.dashboard', compact('user', 'vehicles', 'bookings'));
    }
    
}
