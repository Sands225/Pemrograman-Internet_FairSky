<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
        'flight_class_id',
        'booking_code',
        'passenger_name',
        'passenger_phone',
        'total_price',
        'status',
        'payment_status',
        'booking_date',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'total_price'  => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function flightClass()
    {
        return $this->belongsTo(FlightClass::class);
    }

    public function addons()
    {
        return $this->hasMany(BookingAddon::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
