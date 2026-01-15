<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function airplane()
    {
        return $this->belongsTo(Airplane::class, 'airplane_id');
    }
    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    public function flightClasses()
    {
        return $this->hasMany(FlightClass::class, 'flight_id');
    }
}
