<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAddon extends Model
{
    use HasFactory;

    protected $table = 'booking_addons';

    protected $fillable = [
        'booking_id',
        'type',
        'label',
        'quantity',
    'price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price'    => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
