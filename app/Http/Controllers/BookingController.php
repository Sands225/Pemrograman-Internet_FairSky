<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FlightClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // STEP 1: FORM BOOKING
    public function create(FlightClass $flightClass)
    {
        $flightClass->load('flight.airline', 'flight.originAirport', 'flight.destinationAirport');

        return view('bookings.create', compact('flightClass'));
    }

    // STEP 2: CONFIRM PAGE
    public function confirm(Request $request)
    {
        $request->validate([
            'flight_class_id' => 'required|exists:flight_classes,id',
            'passenger_name' => 'required|string',
            'passenger_phone' => 'required|string',
        ]);

        return view('bookings.confirm', [
            'data' => $request->all()
        ]);
    }

    // STEP 3: SAVE BOOKING
    public function store(Request $request)
    {
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_class_id' => $request->flight_class_id,
            'passenger_name' => $request->passenger_name,
            'passenger_phone' => $request->passenger_phone,
            'status' => 'confirmed',
        ]);

        return redirect()->route('bookings.success', $booking->id);
    }

    // STEP 4: SUCCESS
    public function success(Booking $booking)
    {
        $booking->load('flightClass.flight.airline');

        return view('bookings.success', compact('booking'));
    }
}
