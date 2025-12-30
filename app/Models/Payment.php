<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'payment_method',
        'amount',
        'status',
        'paid_at',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
