<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleGallery extends Model
{
    protected $fillable = ['vehicle_id', 'image_path'];

    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
