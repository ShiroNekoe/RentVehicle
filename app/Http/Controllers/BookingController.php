<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Payment;

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
        return $pdf->download('invoice-booking-' . $booking->id . '.pdf');
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
        $booking->payment_status = 'failed';
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
            'id_user' => Auth::id(), // gunakan Auth::id()
            'rating' => $request->rating,
            'review_date' => now(),
        ]);


        return redirect()->route('user.dashboard')->with('success', 'Ulasan berhasil dikirim.');
    }

   public function history(Request $request)
{
    $query = Booking::with('vehicle')
        ->where('id_user', Auth::id()); // pakai Auth::id()

    if ($request->filled('booking_status')) {
        $query->where('booking_status', $request->booking_status);
    }

    if ($request->filled('payment_status')) {
        $query->where('payment_status', $request->payment_status);
    }

    $bookings = $query->latest()->get();

    return view('user.history', compact('bookings'));
}

public function invoice($id)
{
    $booking = Booking::with('vehicle', 'user')->findOrFail($id);

    // Optional: Pastikan user hanya bisa akses booking miliknya
    if (auth()->id() !== $booking->id_user) {

        abort(403);
    }

    return view('invoice.booking', compact('booking'));
}


public function transferConfirmation($booking_id)
{
    $booking = Booking::findOrFail($booking_id);

    // Contoh: anggap 24 jam dari waktu pemesanan
    $deadline = $booking->created_at->addHours(24)->format('Y-m-d H:i:s');

    return view('pages.transfer-confirmation', [
        'booking' => $booking,
        'deadline' => $deadline, 
    ]);
}


public function showTransferForm(Booking $booking)
{
    return view('pages.transfer-confirmation', compact('booking'));
}

public function submitTransfer(Request $request, Booking $booking)
{
    $request->validate([
        'transfer_to' => 'required|string|max:255',
        'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $path = $request->file('proof')->store('proofs', 'public');

    // Update atau buat payment
    $payment = Payment::updateOrCreate(
        ['id_booking' => $booking->id],
        [
            'payment_status' => 'pending',
            'payment_price' => $booking->booking_price,
            'payment_date' => now(),
            'transfer_to' => $request->transfer_to,
            'proof' => $path,
        ]
    );

    return redirect()->route('transfer.form', $booking->id)->with('success', 'Bukti transfer berhasil dikirim!');
}







}
