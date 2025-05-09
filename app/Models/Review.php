<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['id_booking', 'id_user', 'rating', 'review_date'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
