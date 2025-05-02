<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Driver;

class BookingForm extends Component
{
    use WithFileUploads;

    public $vehicleId;
    public $vehicle;
    public $start_date;
    public $end_date;
    public $booking_price = 0;
    public $payment_method;
    public $phone_security;
    public $phone_person;
    public $nik_identity;
    public $identity;
    public $id_driver;
    public $drivers = [];

public $total_price = 0;
public $days = 0;

    public $isVehicleAvailable = true;

    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'phone_security' => 'required',
        'phone_person' => 'required',
        'nik_identity' => 'required',
        'identity' => 'required|file|mimes:jpg,png,pdf|max:10240',
    ];

    public function mount($vehicleId)
    {
        $this->vehicleId = $vehicleId;
        $this->vehicle = Vehicle::findOrFail($vehicleId);
        $this->drivers = Driver::all();
    }

   
   
public function updated($property)
{
    if ($this->start_date && $this->end_date) {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);

        // Validasi agar end_date tidak lebih awal dari start_date
        if ($end->greaterThanOrEqualTo($start)) {
            $this->days = $start->diffInDays($end) + 1;
            $this->total_price = $this->days * $this->vehicle->price;
        } else {
            $this->days = 0;
            $this->total_price = 0;
        }
    }
}
    
    public function checkVehicleBookingAvailability()
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);

        $existingBooking = Booking::where('id_vehicle', $this->vehicle->id)
            ->where('booking_status', 'ongoing')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                    });
            })
            ->exists();

        $this->isVehicleAvailable = !$existingBooking;
    }

    public function calculateBookingPrice()
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $days = $start->diffInDays($end);
        $driver_fee = $this->id_driver ? 100000 : 0;
        $this->booking_price = $days > 0 ? $this->vehicle->price * $days : 0;
    }

    public function submitBooking()
    {
        $this->validate();
    
        $this->checkVehicleBookingAvailability();
    
        if (!$this->isVehicleAvailable) {
            session()->flash('error', 'Kendaraan tidak tersedia pada tanggal yang dipilih.');
            return;
        }
    
        // Simpan booking terlebih dahulu
        $booking = Booking::create([
            'id_user' => auth()->id(),
            'id_vehicle' => $this->vehicle->id,
            'id_driver' => $this->id_driver,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'booking_price' => $this->total_price,
            'booking_status' => 'ongoing',
            'payment_status' => 'pending',
            'booking_date' => now(),
            'phone_security' => $this->phone_security,
            'phone_person' => $this->phone_person,
            'nik_identity' => $this->nik_identity,
            'identity' => $this->identity->store('identities', 'public'),
            'payment_method' => $this->payment_method,
        ]);
    
        // Midtrans
        if ($this->payment_method === 'midtrans') {
            // Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
    
            // Data Snap
            $params = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $booking->id . '-' . time(),
                    'gross_amount' => $booking->booking_price,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
            ];
    
            // Ambil Snap Token
            $snapToken = \Midtrans\Snap::getSnapToken($params);
    
            // Simpan snap_token di database booking (kalau kolom tersedia)
            $booking->update(['snap_token' => $snapToken]);
    
            // Redirect ke halaman untuk menampilkan Snap
            return redirect()->route('payment.redirect', ['booking' => $booking->id]);
        }
    
        // Jika Transfer Manual
        if ($this->payment_method === 'transfer') {
            return redirect()->route('transfer.confirmation', ['amount' => $booking->booking_price]);
        }
    
        session()->flash('message', 'Booking berhasil!');
    }
    


    public function render()
    {
        return view('livewire.booking-form', [
            'vehicle' => $this->vehicle,
        ]);
    }
}
