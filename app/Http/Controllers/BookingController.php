<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FlightClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\BookingAddon;

class BookingController extends Controller
{

    public function createBookingPage(Request $request, $flightId, $flightClassId)
    {
        $flightClass = FlightClass::with([
            'flight.airline',
            'flight.airplane',
            'flight.originAirport',
            'flight.destinationAirport',
        ])
        ->where('id', $flightClassId)
        ->where('flight_id', $flightId)
        ->firstOrFail();

        return view('bookings.create', compact('flightClass'));
    }

    public function createBooking(Request $request, $flightId, $flightClassId)
    {
        // ================= VALIDATION =================
        $validated = $request->validate([
            'passenger_name'  => 'required|string|max:255',
            'passenger_phone' => 'required|string|max:20',

            'extra_baggage'   => 'nullable|integer|in:0,5,10,20',
            'meal'            => 'required|in:none,standard,vegetarian',
            'insurance'       => 'nullable|boolean',
        ]);

        $booking = DB::transaction(function () use ($validated, $request, $flightId, $flightClassId) {

            // ================= LOCK SEATS =================
            $flightClass = FlightClass::where('flight_id', $flightId)
                ->where('id', $flightClassId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($flightClass->available_seats <= 0) {
                abort(409, 'No seats available');
            }

            $flightClass->decrement('available_seats');

            // ================= BASE PRICE =================
            $basePrice = $flightClass->price;
            $addonsTotal = 0;

            // ================= CREATE BOOKING =================
            $booking = Booking::create([
                'user_id'         => Auth::id(),
                'flight_id'       => $flightClass->flight_id,
                'flight_class_id' => $flightClass->id,
                'booking_code'    => strtoupper(Str::random(8)),
                'passenger_name'  => $validated['passenger_name'],
                'passenger_phone' => $validated['passenger_phone'],
                'status'          => 'pending',
                'payment_status'  => 'Pending',
                'total_price'     => 0, // updated later
                'booking_date'    => now(),
            ]);

            // ================= ADD-ONS =================

            // BAGGAGE
            $baggage = $validated['extra_baggage'] ?? 0;

            if ($baggage > 0) {
                $priceMap = [
                    5  => 150000,
                    10 => 275000,
                    20 => 500000,
                ];

                $price = $priceMap[$baggage];

                BookingAddon::create([
                    'booking_id' => $booking->id,
                    'type'       => 'baggage',
                    'label'      => "Extra Baggage {$baggage}kg",
                    'quantity'   => $baggage,
                    'price'      => $price,
                ]);

                $addonsTotal += $price;
            }

            // MEAL
            if ($validated['meal'] !== 'none') {
                $mealPrices = [
                    'standard'   => 50000,
                    'vegetarian' => 60000,
                ];

                BookingAddon::create([
                    'booking_id' => $booking->id,
                    'type'       => 'meal',
                    'label'      => ucfirst($validated['meal']) . ' Meal',
                    'quantity'   => 1,
                    'price'      => $mealPrices[$validated['meal']],
                ]);

                $addonsTotal += $mealPrices[$validated['meal']];
            }

            // INSURANCE
            if ($request->boolean('insurance')) {
                BookingAddon::create([
                    'booking_id' => $booking->id,
                    'type'       => 'insurance',
                    'label'      => 'Travel Insurance',
                    'quantity'   => 1,
                    'price'      => 35000,
                ]);

                $addonsTotal += 35000;
            }

            // ================= TOTAL PRICE =================
            $subtotal = $basePrice + $addonsTotal;
            $tax = $subtotal * 0.1;

            $booking->update([
                'total_price' => $subtotal + $tax,
            ]);

            return $booking;
        });

        return redirect()->route('payments.create', $booking->id);
    }
}
