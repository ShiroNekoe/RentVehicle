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
        $query = Vehicle::query();
    
        // Cek apakah ada filter
        if ($request->filled('brand')) {
            $query->where('vehicle_brand', $request->brand);
        }
        
        if ($request->filled('model')) {
            $query->where('vehicle_model', $request->model);
        }
        
        if ($request->filled('type')) {
            $query->where('vehicle_type', $request->type);
        }
        
        if ($request->filled('transmission')) {
            $query->where('vehicle_transmission', $request->transmission);
        }
        
        if ($request->filled('seat')) {
            $query->where('seat', $request->seat);
        }
        
        if ($request->filled('nama')) {
            $query->where('vehicle_name', 'like', '%' . $request->nama . '%');
        }        
    
        // Ambil hasil
        $vehicles = $query->latest()->get();
    
        // Ambil 5 riwayat booking terbaru user
        $bookings = Booking::where('id_user', $user->id)
            ->latest()
            ->take(5)
            ->get();

            $popularVehicles = Vehicle::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();
            
            return view('user.dashboard', compact('user', 'vehicles', 'bookings', 'popularVehicles'));
    }
    
}
