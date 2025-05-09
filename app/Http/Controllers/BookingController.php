<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;
use App\Models\Vehicle;

use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function create($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        return view('booking.create', compact('vehicle'));
    }

    public function show($id)
    {
      
    
        $booking = Booking::with('vehicle')->findOrFail($id);
        return view('user.booking_detail', compact('booking'));
    
    }
    public function downloadInvoice(Booking $booking)
    {
        $pdf = Pdf::loadView('pdf.invoice', ['booking' => $booking]);
        return $pdf->download('invoice-booking-'.$booking->id.'.pdf');
    }

    

public function cancel($id)
{
    $booking = Booking::findOrFail($id);

    // Pastikan hanya bisa dibatalkan jika status booking belum selesai atau dibatalkan
    if ($booking->booking_status !== 'completed' && $booking->booking_status !== 'cancelled') {
        $booking->update([
            'booking_status' => 'cancelled',
             'payment_status' => 'failed'
        ]);
    }

    return redirect()->route('user.history')->with('success', 'Booking berhasil dibatalkan');
}

    
}
