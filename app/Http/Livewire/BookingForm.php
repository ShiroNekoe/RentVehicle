<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Midtrans\Config;
use Midtrans\Snap;

class BookingForm extends Component
{
    use WithFileUploads;

    public $vehicleId;
    public $vehicle;
    public $start_date;
    public $end_date;
    public $booking_price = 0;
    public $phone_security;
    public $phone_person;
    public $nik_identity;
    public $identity;
    public $id_driver;
    public $drivers = [];
    public $pickup_location;
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
        $this->calculateDaysAndPrice();
    }

    public function calculateDaysAndPrice()
    {
        if ($this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);

            if ($end->greaterThanOrEqualTo($start)) {
                $this->days = $start->diffInDays($end) + 1;
                $this->total_price = $this->days * $this->vehicle->price;

                if ($this->id_driver) {
                    $this->total_price += 100000; // Tambah biaya driver
                }
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
            })->exists();

        $this->isVehicleAvailable = !$existingBooking;
    }

    public function submitBooking()
    {
        $this->validate();
        $this->calculateDaysAndPrice();
        $this->checkVehicleBookingAvailability();

        if (! $this->isVehicleAvailable) {
            session()->flash('error', 'Kendaraan sudah dibooking di tanggal tersebut.');
            return;
        }

        if ($this->total_price < 1) {
            session()->flash('error', 'Total harga tidak valid.');
            return;
        }

        // Simpan booking ke DB
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
            'booking_price' => $this->total_price,
            'payment_method' => 'midtrans',
            'booking_status' => 'ongoing',
            'pickup_location' => $this->pickup_location,
            'booking_date' => now(),
        ]);

        // MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'BOOK-' . $booking->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $this->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $this->phone_person,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // Trigger ke browser untuk buka popup
        $this->dispatchBrowserEvent('midtrans-payment', [
            'snapToken' => $snapToken
        ]);
        session()->flash('snap_token', $snapToken);

    }

    public function render()
    {
        return view('livewire.booking-form', [
            'vehicle' => $this->vehicle,
        ]);
    }
}
