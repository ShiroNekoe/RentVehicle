<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_name' ,'vehicle_type', 'vehicle_model', 'vehicle_transmission',
        'vehicle_brand', 'number_plate', 'seat', 'price', 'status'
    ];


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

        public function galleries()
    {
        return $this->hasMany(VehicleGallery::class, 'vehicle_id');
    }

}
