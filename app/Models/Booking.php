<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
    'id_user',
    'id_vehicle',
    'id_driver',
    'start_date',
    'end_date',
    'booking_date',
    'payment_status',
    'booking_status',
    'booking_price',
    'phone_security',
    'phone_person',
    'nik_identity',
    'identity',
    'pickup_location',
    'return_location',
    'return_option',
];


        protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'booking_date' => 'date', // kalau ini hanya tanggal tanpa waktu
    ];
    
    
    

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_vehicle');
    }

    public function driver()
{
    return $this->belongsTo(Driver::class, 'id_driver'); 
}

    
    
    public function return()
    {
        return $this->hasOne(VehicleReturn::class); 
    }
    

    public function review()
    {
        return $this->hasOne(Review::class, 'id_booking');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_booking');
    }

    
}
