<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET /api/orders?status=booking|ongoing|completed|canceled
    public function index(Request $request)
    {
        $status = $request->query('status', 'booking');

        $validStatuses = ['booking', 'ongoing', 'completed', 'canceled'];

        if (!in_array($status, $validStatuses)) {
            return response()->json([
                'success' => false,
                'message' => "Invalid status filter. Valid statuses: " . implode(", ", $validStatuses),
            ], 422);
        }

        // Jika status = booking maka ambil semua data tanpa filter status
        if ($status === 'booking') {
            $bookings = Booking::with('vehicle')
                ->orderBy('start_date', 'desc')
                ->get();
        } else {
            // Filter berdasarkan status yang ada: ongoing, completed, canceled
            $bookings = Booking::with('vehicle')
                ->where('booking_status', $status)
                ->orderBy('start_date', 'desc')
                ->get();
        }

        $data = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'status' => $booking->booking_status,
                'carName' => $booking->vehicle ? $booking->vehicle->name : 'Unknown',
                'location' => $booking->pickup_location ?? 'Unknown',
                'dateRange' => date('d M Y', strtotime($booking->start_date)) . " - " . date('d M Y', strtotime($booking->end_date)),
                'price' => "Rp " . number_format($booking->booking_price, 0, ',', '.'),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
