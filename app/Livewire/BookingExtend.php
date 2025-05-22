<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Booking;

class BookingExtend extends Component
{
    public Booking $booking;
    public $new_end_date;
    public $payment_method;
    public $price = 0;

    // Validasi dasar; validasi after booking.end_date dilakukan manual di submit()
    protected $rules = [
        'new_end_date' => 'required|date',
        'payment_method' => 'required|in:cod,transfer',
    ];

    public function mount(Booking $booking)
    {
        $this->booking = $booking;
        $this->new_end_date = null;
        $this->price = 0;
    }

    public function updatedNewEndDate()
    {
        if (!$this->new_end_date) {
            $this->price = 0;
            return;
        }

        $originalEnd = Carbon::parse($this->booking->end_date);
        $newEnd = Carbon::parse($this->new_end_date);

        if ($newEnd->gt($originalEnd)) {
            $days = $originalEnd->diffInDays($newEnd);
            $this->price = $days * $this->booking->vehicle->price;
        } else {
            $this->price = 0;
        }
    }

    public function submit()
    {
        $this->validate();

        $originalEnd = Carbon::parse($this->booking->end_date);
        $newEnd = Carbon::parse($this->new_end_date);

        if (!$newEnd->gt($originalEnd)) {
            $this->addError('new_end_date', 'Tanggal baru harus lebih lama dari tanggal akhir sebelumnya.');
            return;
        }

        $days = $originalEnd->diffInDays($newEnd);
        $this->price = $days * $this->booking->vehicle->price;

        if ($this->price <= 0) {
            $this->addError('price', 'Harga perpanjangan tidak boleh nol.');
            return;
        }

        session([
            'extend_booking_id' => $this->booking->id,
            'extend_new_end_date' => $this->new_end_date,
            'extend_price' => $this->price,
        ]);

        return redirect()->to(
            $this->payment_method === 'transfer'
                ? route('pages.transfer-confirmation', ['booking_id' => $this->booking->id])
                : route('pages.cod-invoice', ['booking_id' => $this->booking->id])
        );
    }

    public function render()
    {
        return view('livewire.booking-extend');
    }
}
