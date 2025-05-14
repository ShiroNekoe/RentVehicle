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

    // Mengambil data booking yang sedang berjalan
    public function mount($booking)
    {
        $this->booking = $booking;
    }

    // Menghitung harga perpanjangan berdasarkan tanggal yang dipilih
    public function updatedNewEndDate()
    {
        if ($this->new_end_date) {
            // Hitung selisih hari antara tanggal sekarang dengan tanggal baru
            $days = Carbon::parse($this->booking->end_date)->diffInDays(Carbon::parse($this->new_end_date));
            // Kalkulasi harga berdasarkan perbedaan hari
            $this->price = $days * $this->booking->vehicle->price_per_day;
        }
    }

    // Proses form saat submit
    public function submit()
    {
        $this->validate([
            'new_end_date' => 'required|after:today', // Validasi tanggal baru setelah hari ini
            'payment_method' => 'required|in:midtrans,transfer',
        ]);

        // Simpan data yang diperlukan ke session sebelum redirect
        session([
            'extend_booking_id' => $this->booking->id,
            'extend_new_end_date' => $this->new_end_date,
            'extend_price' => $this->price,
        ]);

        if ($this->payment_method === 'midtrans') {
            // Redirect ke halaman pembayaran Midtrans
            return redirect()->route('midtrans.extend.payment', $this->booking->id);
        }

        // Redirect ke halaman transfer manual
        return redirect()->route('pages.transfer-confirmation');
    }

    public function render()
    {
        return view('livewire.booking-extend');
    }
}
