<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FlightClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{

    public function createBookingPage(Request $request, $flightId)
    {
        $flightClass = FlightClass::with([
            'flight.airline',
            'flight.airplane',
            'flight.originAirport',
            'flight.destinationAirport',
        ])
        ->where('flight_id', $flightId)
        ->firstOrFail();

        return view('bookings.create', compact('flightClass'));
    }

    public function createBooking(Request $request, $flightId)
    {;
        $validated = $request->validate([
            'passenger_name'  => 'required|string',
            'passenger_phone' => 'required|string',
        ]);

        $booking = DB::transaction(function () use ($validated, $flightId) {

            $flightClass = FlightClass::where('flight_id', $flightId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($flightClass->available_seats <= 0) {
                abort(409, 'No seats available');
            }

            $flightClass->decrement('available_seats');

            $price = $flightClass->price;
            $tax   = $price * 0.1;

            return Booking::create([
                'user_id'         => Auth::id(),
                'flight_id'       => $flightClass->flight_id,
                'flight_class_id' => $flightClass->id,
                'booking_code'    => strtoupper(Str::random(8)),
                'passenger_name'  => $validated['passenger_name'],
                'passenger_phone' => $validated['passenger_phone'],
                'status'          => 'pending',
                'payment_status'  => 'Pending',
                'total_price'     => $price + $tax,
                'booking_date'    => now(),
            ]);
        });

        return redirect()->route('payments.create', $booking->id);
    }
}
