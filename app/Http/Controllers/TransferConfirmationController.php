<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class TransferConfirmationController extends Controller
{
    public function show(Request $request, $booking_id)
    {
        $booking = Booking::with('vehicle')->findOrFail($booking_id);

        $new_end_date = session('extend_new_end_date');
        $extend_price = session('extend_price');

        if (!$new_end_date || !$extend_price) {
            return redirect()->route('user.history')->with('error', 'Data perpanjangan tidak ditemukan atau sudah kadaluarsa.');
        }

        return view('pages.transfer-confirmation-extend', [
            'booking' => $booking,
            'new_end_date' => $new_end_date,
            'price' => $extend_price,
        ]);
    }
}
