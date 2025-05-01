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

    public function show(Booking $booking)
    {
        return view('payment.checkout', compact('booking'));
    }
    public function downloadInvoice(Booking $booking)
    {
        $pdf = Pdf::loadView('pdf.invoice', ['booking' => $booking]);
        return $pdf->download('invoice-booking-'.$booking->id.'.pdf');
    }
    
}
