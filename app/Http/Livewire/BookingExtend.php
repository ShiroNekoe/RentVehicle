<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Booking;

class BookingExtend extends Component
{
    public $booking;
    public $new_end_date;
    public $payment_method;
    public $price;

    public function mount($booking)
    {
        $this->booking = $booking;
        $this->price = 0;
    }

    public function updatedNewEndDate()
    {
        if ($this->new_end_date) {
            $days = Carbon::parse($this->booking->end_date)->diffInDays(Carbon::parse($this->new_end_date));
            $this->price = $days * $this->booking->vehicle->price_per_day;
        }
    }

 public function submit()
{
    $this->validate([
        'new_end_date' => 'required|after:today',
        'payment_method' => 'required|in:midtrans,transfer',
    ]);

    // Simpan data extend booking di session
    session([
        'extend_booking_id' => $this->booking->id,
        'extend_new_end_date' => $this->new_end_date,
        'extend_price' => $this->price,
    ]);

    if ($this->payment_method === 'midtrans') {
        return redirect()->route('midtrans.extend.payment', $this->booking->id);
    }

    return redirect()->route('pages.transfer.confirmation');
}


    public function render()
    {
        return view('livewire.booking-extend');
    }
}
