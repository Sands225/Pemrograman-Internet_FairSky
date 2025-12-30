<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\FlightClass;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function createPaymentPage($bookingId)
    {
        $booking = Booking::with([
            'flightClass.flight.airline',
            'flightClass.flight.originAirport',
            'flightClass.flight.destinationAirport',
            'payment',
        ])
        ->where('id', $bookingId)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        // If already paid, skip payment page
        if ($booking->payment) {
            return redirect()->route('payments.success', $booking->id);
        }

        return view('payments.create', compact('booking'));
    }

    public function createPayment(Request $request, $bookingId)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->lockForUpdate()
            ->firstOrFail();

        // Prevent double payment
        if ($booking->payment) {
            abort(409, 'Booking already paid.');
        }

        DB::transaction(function () use ($booking, $request) {

            Payment::create([
                'booking_id'     => $booking->id,
                'payment_method' => $request->payment_method,
                'amount'         => $booking->total_price,
                'payment_status' => 'paid',
                'paid_at'        => now(),
            ]);

            $booking->update([
                'status'         => 'confirmed',
                'payment_status' => 'Paid',
            ]);
        });

        return redirect()->route('payments.success', $booking->id);
    }

    public function successPaymentPage($bookingId)
    {
        $booking = Booking::with([
            'payment',
            'flightClass.flight.airline',
            'flightClass.flight.originAirport',
            'flightClass.flight.destinationAirport',
        ])
        ->where('id', $bookingId)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        abort_unless($booking->payment, 404);

        return view('payments.success', compact('booking'));
    }




    // // STEP 2: PROCESS PAYMENT
    // public function storePayment(Request $request)
    // {
    //     $request->validate([
    //         'payment_method' => 'required|string',
    //     ]);

    //     $data = session('booking_data');

    //     if (! $data) {
    //         abort(403, 'Booking data expired.');
    //     }

    //     // Simpan booking (pembayaran sukses)
    //     $booking = Booking::create([
    //         'user_id'         => Auth::id(),
    //         'flight_class_id' => $data['flight_class_id'],
    //         'booking_code'    => strtoupper(uniqid('BK')),
    //         'passenger_name'  => $data['passenger_name'],
    //         'passenger_phone' => $data['passenger_phone'],
    //         'status'          => 'confirmed',
    //         'total_price'     => $data['total_price'],
    //         'payment_status'  => 'Paid',
    //         'booking_date'    => now(),
    //     ]);

    //     // Bersihkan session
    //     session()->forget('booking_data');

    //     return redirect()->route('payments.success', $booking->id);
    // }

    // // STEP 3: PAYMENT SUCCESS
    // public function success(Booking $booking)
    // {
    //     $booking->load('flightClass.flight.airline');

    //     return view('payments.success', compact('booking'));
    // }
}
