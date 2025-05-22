<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;

class BookingForm extends Component
{
    use WithFileUploads;

    public $vehicleId;
    public $vehicle;
    public $start_date, $end_date, $start_time, $end_time;
    public $phone_security, $phone_person, $nik_identity, $identity;
    public $pickup_location, $payment_method;
    public $id_driver = null;
    public $use_driver = false;
    public $booking_price = 0;
    public $total_price = 0;
    public $days = 0;
    public $isVehicleAvailable = true;
     public $return_option = 'showroom';
    public $return_location = null;
    

    /** @var \Illuminate\Support\Collection<int, \App\Models\Driver> */
    public Collection $drivers;

   protected function rules()
{
    return [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'start_time' => 'required|date_format:H:i',
       'end_time' => 'required|date_format:H:i|same:start_time',
        'phone_security' => 'required|numeric|digits_between:12,15',
        'phone_person' => 'required|numeric|digits_between:12,15',
        'nik_identity' => 'required|numeric|digits:16',
        'identity' => 'required|file|mimes:jpg,png,pdf|max:10240',
        'pickup_location' => 'nullable|string|max:255',
        'payment_method' => 'required|in:transfer,cod',
        'return_option' => 'required|in:showroom,other',
        'return_location' => $this->return_option === 'other' ? 'required|string|max:255' : 'nullable',
    ];
}


    public function mount($vehicleId)
    {
        $this->vehicleId = $vehicleId;
        $this->vehicle = Vehicle::findOrFail($vehicleId);
        $this->drivers = Driver::all(); // pastikan ini Collection
    }

public function updated($property)
{
    if ($property === 'use_driver') {
        $this->use_driver = (bool) $this->use_driver;

        if ($this->use_driver && $this->drivers->isNotEmpty()) {
            $this->id_driver = $this->drivers->random()->id;
        } else {
            $this->id_driver = null;
        }
    }

    if ($property === 'start_date') {
        $this->end_date = $this->start_date;
    }

    if ($property === 'start_time') {
        $this->end_time = $this->start_time;
    }

    if (in_array($property, ['start_date', 'end_date', 'start_time', 'end_time'])) {
        $this->calculateDaysAndPrice();
    }
}



    public function calculateDaysAndPrice()
    {
        if ($this->start_date && $this->start_time) {
            $start = Carbon::parse("{$this->start_date} {$this->start_time}");
            $end = $start->copy()->addDay(); // otomatis 24 jam

            $this->end_date = $end->toDateString();
            $this->end_time = $end->format('H:i');

            $this->checkVehicleBookingAvailability();

            $this->days = 1;
            $this->total_price = $this->days * $this->vehicle->price;

            if ($this->use_driver && $this->id_driver) {
                $this->total_price += 125000;
            }
        }
    }


    public function checkVehicleBookingAvailability()
    {
        $start = Carbon::parse("{$this->start_date} {$this->start_time}");
        $end = Carbon::parse("{$this->end_date} {$this->end_time}");

        $overlap = Booking::where('id_vehicle', $this->vehicleId)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('start_date', '<=', $start)
                          ->where('end_date', '>=', $end);
                    });
            })
            ->exists();

        $this->isVehicleAvailable = !$overlap;

        if (!$this->isVehicleAvailable) {
            session()->flash('error', 'Kendaraan tidak tersedia untuk rentang waktu yang dipilih.');
        }
    }

       public function updatedReturnOption($value)
    {
        if ($value === 'showroom') {
            $this->return_location = null;
        }
    }

    public function submitBooking()
    {
        $this->validate();
        $this->calculateDaysAndPrice();

        if (!$this->isVehicleAvailable) {
            session()->flash('error', 'Kendaraan sudah dibooking di waktu tersebut.');
            return;
        }

        if ($this->total_price < 1) {
            session()->flash('error', 'Total harga tidak valid.');
            return;
        }

        if ($this->use_driver && !$this->id_driver) {
            session()->flash('error', 'Driver tidak tersedia.');
            return;
        }

        $startDateTime = Carbon::parse("{$this->start_date} {$this->start_time}");
        $endDateTime = Carbon::parse("{$this->end_date} {$this->end_time}");

        $identityPath = $this->identity->store('identities', 'public');

        $booking = Booking::create([
            'id_user' => Auth::id(),
            'id_vehicle' => $this->vehicle->id,
            'id_driver' => $this->id_driver,
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'phone_person' => $this->phone_person,
            'phone_security' => $this->phone_security,
            'nik_identity' => $this->nik_identity,
            'identity' => $identityPath,
            'booking_price' => $this->total_price,
            'booking_status' => 'ongoing',
            'pickup_location' => $this->pickup_location,
            'return_option' => $this->return_option,
            'return_location' => $this->return_option === 'other' ? $this->return_location : null,
            'booking_date' => now(),
        ]);

        return redirect()->to(
            $this->payment_method === 'transfer'
                ? route('pages.transfer-confirmation', ['booking_id' => $booking->id])
                : route('pages.cod-invoice', ['booking_id' => $booking->id])
        );
    }

    public function render()
    {
        return view('livewire.booking-form', [
            'vehicle' => $this->vehicle,
        ]);
    }
}
