<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Driver;
use Midtrans\Snap;
use Midtrans\Config;

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

    public $pickup_location;
    public $agree_terms = false;

public $total_price = 0;
public $days = 0;

    public $isVehicleAvailable = true;

    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'phone_security' => 'required|numeric|digits_between:12,15',
        'phone_person' => 'required|numeric|digits_between:12,15',
        'nik_identity' => 'required|numeric|digits:16',
        'identity' => 'required|file|mimes:jpg,png,pdf|max:10240',
        'pickup_location' => 'nullable|string|max:255', 
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
    
        $this->total_price = $this->vehicle->price * $this->days + ($this->id_driver ? 100000 : 0);
    
        // Validasi total_price untuk memastikan lebih dari 0
        if ($this->total_price < 0.01) {
            session()->flash('error', 'Total harga harus lebih dari 0');
            return;
        }
    
        // Simpan booking ke database
        $booking = Booking::create([
            'id_user' => Auth::id(),
            'id_vehicle' => $this->vehicle->id,
            'id_driver' => $this->id_driver,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone_person' => $this->phone_person,
            'phone_security' => $this->phone_security,
            'nik_identity' => $this->nik_identity,
            'identity' => $this->identity->store('identities', 'public'),
            'booking_price' => $this->total_price,  // Gunakan total_price
            'payment_method' => $this->payment_method,
            'status' => 'pending',
            'pickup_location' => $this->pickup_location,
            'booking_date' => Carbon::now(),
        ]);
    
        // Metode pembayaran Transfer
        if ($this->payment_method === 'transfer') {
            return redirect()->route('transfer.confirmation', ['amount' => $this->total_price]);
        }
    
        // Metode Pembayaran Midtrans
        if ($this->payment_method === 'midtrans') {
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = false;  // Pastikan mode ini sesuai dengan lingkungan Anda
    
            $midtrans = new Snap();
            $params = [
                'transaction_details' => [
                    'order_id' => 'BOOK-' . $booking->id . '-' . time(),
                    'gross_amount' => (int)$this->total_price,  // Pastikan total_price yang benar
                ],
                'customer_details' => [
                   'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];
    
            $snapToken = $midtrans->getSnapToken($params);
            session()->flash('snap_token', $snapToken);
    
            return;
        }
    }
    


    public function render()
    {
        return view('livewire.booking-form', [
            'vehicle' => $this->vehicle,
        ]);
    }
}
