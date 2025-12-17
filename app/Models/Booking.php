<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'flight_class_id',
        'passenger_name',
        'passenger_phone',
        'status',
    ];

    public function flightClass()
    {
        return $this->belongsTo(FlightClass::class);
    }
}
