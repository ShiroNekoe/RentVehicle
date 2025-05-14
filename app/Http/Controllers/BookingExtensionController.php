<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth; // Pastikan sudah ada baris ini
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingExtensionController extends Controller
{
    public function showForm($id)
    {
        $booking = Booking::with('vehicle')->findOrFail($id);

        // Cek apakah user yang punya booking
        if ($booking->id_user !== Auth::id()) { // Ganti auth()->id() dengan Auth::id()
            abort(403);
        }

        return view('user.extend-booking', compact('booking'));
    }

    public function processExtension(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->id_user !== Auth::id()) { // Ganti auth()->id() dengan Auth::id()
            abort(403);
        }

        $request->validate([
            'new_end_date' => 'required|date|after:' . $booking->end_date,
        ]);

        // Hitung selisih hari & harga tambahan
        $oldEnd = Carbon::parse($booking->end_date);
        $newEnd = Carbon::parse($request->new_end_date);
        $additionalDays = $oldEnd->diffInDays($newEnd);
        $additionalPrice = $additionalDays * $booking->vehicle->price;

        // Perbarui data
        $booking->end_date = $newEnd;
        $booking->booking_price += $additionalPrice;
        $booking->save();

        return redirect()->route('user.history')->with('success', 'Booking berhasil diperpanjang.');
    }
}
