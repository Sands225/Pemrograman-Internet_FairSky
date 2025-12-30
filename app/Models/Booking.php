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
        'status',
        'payment_status',
        'total_price',
        'booking_date',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function flightClass()
    {
        return $this->belongsTo(FlightClass::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
