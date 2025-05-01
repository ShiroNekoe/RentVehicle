<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'status',
    ];


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
