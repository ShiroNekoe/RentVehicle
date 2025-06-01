<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VehicleController extends Controller
{
    // GET /api/vehicles
    public function index()
    {
        $vehicles = Vehicle::with('galleries')->latest()->get();
        return response()->json($vehicles);
    }

    // GET /api/vehicles/{id}
    public function show($id)
    {
        $vehicle = Vehicle::with('galleries')->findOrFail($id);
        return response()->json($vehicle);
    }

    // GET /api/vehicles/cars   
    public function cars()
    {
        $cars = Vehicle::with(['galleries', 'reviews.user'])
            ->where('vehicle_type', 'car')
            ->latest()
            ->get();

        return response()->json($cars);
    }

    public function motorcycles()
    {
        $motorcycles = Vehicle::with(['galleries', 'reviews.user'])
            ->where('vehicle_type', 'motorcycles')
            ->latest()
            ->get();

        return response()->json($motorcycles);
    }

    public function vehiclesByBookingStatus(Request $request)
    {
        $status = $request->query('status');

        // Daftar status yang valid, 'booking' berarti semua booking tanpa filter
        $validStatuses = ['booking', 'ongoing', 'completed', 'cancelled'];

        if (!$status || !in_array($status, $validStatuses)) {
            return response()->json([
                'success' => false,
                'message' => "Parameter status harus diisi dengan salah satu dari: " . implode(', ', $validStatuses),
            ], 422);
        }

        if ($status === 'booking') {
            // Semua kendaraan yang punya minimal 1 booking (tanpa filter status)
            $vehicles = Vehicle::whereHas('bookings')
                ->with(['galleries', 'bookings'])
                ->latest()
                ->get();
        } else {
            // Kendaraan yang punya booking dengan status tertentu
            $vehicles = Vehicle::whereHas('bookings', function ($query) use ($status) {
                $query->where('booking_status', $status);
            })
                ->with(['galleries', 'bookings' => function ($query) use ($status) {
                    $query->where('booking_status', $status);
                }])
                ->latest()
                ->get();
        }

        // Opsional: supaya respons JSON lebih bersih dan tidak terlalu berat,
        // kamu bisa map data kendaraan dan hanya kirim field yang diperlukan,
        // contoh sederhana:
        $result = $vehicles->map(function ($vehicle) {
            return [
                'id' => $vehicle->id,
                'name' => $vehicle->name,
                'vehicle_type' => $vehicle->vehicle_type,
                'galleries' => $vehicle->galleries->map(fn($g) => ['id' => $g->id, 'url' => $g->url]),
                'bookings' => $vehicle->bookings->map(fn($b) => [
                    'id' => $b->id,
                    'start_date' => $b->start_date,
                    'end_date' => $b->end_date,
                    'booking_status' => $b->booking_status,
                    'booking_price' => $b->booking_price,
                    // tambahkan field lain yang ingin dikirim
                ]),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }
}
