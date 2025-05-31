<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    'id_booking',
    'payment_status',
    'payment_price',
    'payment_method',
    'payment_date',
    'transfer_to',
    'proof',
    ];


    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }
}
