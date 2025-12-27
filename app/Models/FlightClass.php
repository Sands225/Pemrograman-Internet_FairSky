<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightClass extends Model
{
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
