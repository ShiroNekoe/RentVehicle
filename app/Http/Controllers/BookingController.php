<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Review;
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

    

    public function cancel(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Validasi status
        if ($booking->booking_status === 'completed' || $booking->booking_status === 'cancelled') {
            return redirect()->back()->with('error', 'Booking tidak dapat dibatalkan.');
        }

        // Update status booking dan pembayaran
        $booking->booking_status = 'cancelled';
        $booking->payment_status = 'failed'; // Tambahan ini
        $booking->save();

        // Redirect ke halaman konfirmasi admin
        return redirect()->route('booking.admin_confirm')->with('success', 'Booking berhasil dibatalkan.');
    }



public function reviewForm(Booking $booking)
{
    if (
        $booking->review ||
        $booking->payment_status !== 'paid' ||
        $booking->booking_status !== 'completed'
    ) {
        return redirect()->route('user.dashboard')->with('error', 'Kamu hanya bisa memberikan ulasan jika booking selesai dan pembayaran lunas.');
    }

    return view('user.review', compact('booking'));
}

public function submitReview(Request $request, Booking $booking)
{
    if (
        $booking->review ||
        $booking->payment_status !== 'paid' ||
        $booking->booking_status !== 'completed'
    ) {
        return redirect()->route('user.dashboard')->with('error', 'Akses tidak valid untuk beri ulasan.');
    }

    $request->validate([
        'rating' => 'required|in:1,2,3,4,5',
    ]);

    Review::create([
        'id_booking' => $booking->id,
        'id_user' => auth()->id(),
        'rating' => $request->rating,
        'review_date' => now(),
    ]);

    return redirect()->route('user.dashboard')->with('success', 'Ulasan berhasil dikirim.');
}


    
}
