<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class ExtendBooking extends Component
{
    public Booking $booking;

    public $newEndDate;
    public $paymentMethod = 'transfer'; // default payment method

    protected function rules()
    {
        return [
            'newEndDate' => ['required', 'date', 'after:' . $this->booking->end_date],
            'paymentMethod' => ['required', Rule::in(['transfer', 'cod'])],
        ];
    }

   public function mount(Booking $booking)
    {
        $this->booking = $booking;
        $this->newEndDate = $booking->end_date->addDay()->format('Y-m-d'); // sekarang ini sudah objek Carbon
    }

public function submit()
{
    $this->validate();

    // Update data booking
    $this->booking->end_date = $this->newEndDate;
    $this->booking->booking_status = 'ongoing';
    $this->booking->save();

    // Buat pembayaran baru, isi payment_date supaya tidak error
    $payment = $this->booking->payment()->create([
        'payment_method' => $this->paymentMethod,
        'payment_status' => 'pending',
        'payment_price' => $this->booking->booking_price,
        'amount' => $this->booking->booking_price,
        'payment_date' => Carbon::now(),  // <- ini yang kamu butuhkan
    ]);

    // Redirect ke halaman konfirmasi transfer
    return redirect()->route('transfer.confirmation.extend', ['payment' => $payment->id]);
}


    public function render()
    {
        return view('livewire.extend-booking');
    }
}
