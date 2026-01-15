<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
                'user',
                'flight',
                'flightClass',
            ])
            ->latest('booking_date')
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['addons', 'tickets', 'user', 'flight']);

        return view('admin.bookings.show', compact('booking'));
    }
}
