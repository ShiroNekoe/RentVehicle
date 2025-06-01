<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // GET /api/bookings
    public function index(Request $request)
    {
        $status = $request->query('status');

        $validStatuses = ['ongoing', 'completed', 'cancelled'];

        $query = Booking::with(['vehicle.galleries']);

        if ($status && in_array($status, $validStatuses)) {
            $query->where('booking_status', $status);
        }
        // Jika status kosong atau tidak valid, ambil semua booking (sesuai Flutter 'booking' berarti all)

        $bookings = $query->latest()->get();

        // Format response sesuai yang Flutter butuhkan
        $result = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'booking_status' => $booking->booking_status,
                'booking_price' => $booking->booking_price,
                'pickup_location' => $booking->pickup_location ?? '-',
                'start_date' => $booking->start_date->toDateString(),
                'end_date' => $booking->end_date->toDateString(),

                // Data kendaraan
                'name' => $booking->vehicle->name ?? 'Unknown Vehicle',
                'vehicle_type' => $booking->vehicle->vehicle_type ?? '',
                'galleries' => $booking->vehicle->galleries->map(fn($g) => ['id' => $g->id, 'url' => $g->url]),

                // Lokasi booking (misal alamat user atau showroom)
                'location' => $booking->pickup_location ?? '-',
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    // POST /api/bookings
public function store(Request $request)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'id_vehicle' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'booking_price' => 'required|numeric',
            'phone_security' => 'required|numeric|digits_between:12,15',
            'phone_person' => 'required|numeric|digits_between:12,15',
            'nik_identity' => 'required|numeric|digits:16',
            'identity' => 'required|file|mimes:jpg,png,pdf|max:10240',
            'pickup_location' => 'nullable|string|max:255',
            'return_option' => 'required|in:showroom,other',
            'payment_method' => 'required|in:transfer,cod',
            // Tidak perlu validasi return_location, karena akan diisi otomatis
        ]);

        // Simpan file KTP ke storage
        $identityPath = $request->file('identity')->store('identities', 'public');

        // Ambil user ID
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Set return_location sama dengan pickup_location
        $returnLocation = $validated['pickup_location'] ?? null;

        // Simpan ke database
        $booking = Booking::create([
            'id_user' => $userId,
            'id_vehicle' => $validated['id_vehicle'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'booking_price' => $validated['booking_price'],
            'phone_security' => $validated['phone_security'],
            'phone_person' => $validated['phone_person'],
            'nik_identity' => $validated['nik_identity'],
            'identity' => $identityPath,
            'pickup_location' => $validated['pickup_location'] ?? null,
            'return_location' => $returnLocation,
            'payment_method' => $validated['payment_method'],
            'return_option' => $validated['return_option'],
            'booking_status' => 'ongoing',
            'booking_date' => now(),
        ]);

        return response()->json([
            'message' => 'Booking berhasil dibuat',
            'id' => $booking->id,
            'data' => $booking
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error: ' . $e->getMessage(),
        ], 500);
    }
}


public function show($id)
{
    // Pastikan user sudah login
    $user = Auth::user();

    // Cari booking yang dimiliki user
    $booking = Booking::with(['vehicle', 'driver', 'return', 'review', 'payment'])
        ->find($id);

    if (!$booking) {
        return response()->json(['message' => 'Booking not found or access denied.'], 404);
    }

    return response()->json([
        'bookingId' => $booking->id,
        'vehicle' => $booking->vehicle,
        'driver' => $booking->driver,
        'startDate' => $booking->start_date,
        'endDate' => $booking->end_date,
        'paymentStatus' => $booking->payment_status,
        'bookingStatus' => $booking->booking_status,
        'bookingPrice' => $booking->booking_price,
        'return' => $booking->return,
        'review' => $booking->review,
        'payment' => $booking->payment,
    ]);
}




    public function filterByBookingStatus(Request $request)
    {
        $status = $request->query('status'); // dapatkan parameter status dari query string

        // Jika status kosong atau null, tampilkan semua booking dengan status apapun
        $query = Booking::with('vehicle');

        if ($status) {
            // Mapping jika perlu, tapi disesuaikan sama frontend (ongoing, completed, cancelled)
            $statusMap = [
                'ongoing' => 'ongoing',
                'completed' => 'completed',
                'cancelled' => 'cancelled',
                'canceled' => 'cancelled', // bisa jadi typo, mapping ke cancelled
            ];

            $mappedStatus = $statusMap[strtolower($status)] ?? null;

            if ($mappedStatus) {
                $query->where('booking_status', $mappedStatus);
            }
        }

        $bookings = $query->get();

        // Format response sesuai yang Flutter butuhkan
        $data = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'booking_status' => $booking->booking_status,
                'name' => $booking->vehicle->name ?? 'Unknown Vehicle',
                'pickup_location' => $booking->pickup_location,
                'start_date' => $booking->start_date ? $booking->start_date->format('Y-m-d') : null,
                'end_date' => $booking->end_date ? $booking->end_date->format('Y-m-d') : null,
                'booking_price' => $booking->booking_price,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function getBookings(Request $request)
    {
        $status = $request->query('booking_status', 'booking');

        $validStatuses = ['booking', 'ongoing', 'completed', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid status filter',
            ], 400);
        }

        if ($status === 'booking') {
            $bookings = DB::table('bookings')
                ->join('vehicles', 'bookings.id_vehicle', '=', 'vehicles.id')
                ->whereIn('bookings.booking_status', ['ongoing', 'completed', 'cancelled'])
                ->select(
                    'bookings.*',
                    'vehicles.vehicle_name',
                    'vehicles.price as vehicle_price'  // ambil harga kendaraan
                )
                ->get();
        } else {
            $bookings = DB::table('bookings')
                ->join('vehicles', 'bookings.id_vehicle', '=', 'vehicles.id')
                ->where('bookings.booking_status', $status)
                ->select(
                    'bookings.*',
                    'vehicles.vehicle_name',
                    'vehicles.price as vehicle_price'  // ambil harga kendaraan
                )
                ->get();
        }

        $result = $bookings->map(function ($item) {
            // Gabungkan pickup_location dan return_location
            $locationCombined = trim($item->pickup_location ?? '') . ' - ' . trim($item->return_location ?? '');

            return [
                'id' => $item->id,
                'carName' => $item->vehicle_name ?? 'Unknown Vehicle',
                'location' => $locationCombined ?: 'Unknown Location',
                'dateRange' => date('d M Y', strtotime($item->start_date)) . ' - ' . date('d M Y', strtotime($item->end_date)),
                'price' => isset($item->vehicle_price)
                    ? 'Rp ' . number_format($item->vehicle_price, 0, ',', '.')
                    : 'Rp 0',
                'status' => $item->booking_status,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $result,
        ]);
    }
}
