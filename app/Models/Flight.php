<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Maskapai
    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    // Relasi ke Bandara Asal
    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    // Relasi ke Bandara Tujuan
    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    // Relasi ke Kelas Penerbangan (Untuk ambil Harga)
    public function flightClasses()
    {
        return $this->hasMany(FlightClass::class, 'flight_id');
    }
}
