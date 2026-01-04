<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\FlightClass;
use App\Models\Payment;
use App\Services\TicketService;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function createPaymentPage($bookingId)
    {
        $booking = Booking::with([
            'flightClass.flight.airline',
            'flightClass.flight.originAirport',
            'flightClass.flight.destinationAirport',
            'addons',
            'payment',
        ])
        ->where('id', $bookingId)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        // dd($booking);

        if ($booking->payment) {
            return redirect()->route('payments.success.page', $booking->id);
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
        // if ($booking->payment) {
        //     abort(409, 'Booking already paid.');
        // }

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

        return redirect()->route('payments.success.page', $booking->id);
    }

    public function successPaymentPage($bookingId)
    {
        $booking = Booking::with([
            'payment',
            'ticket',
            'flightClass.flight.airline',
            'flightClass.flight.originAirport',
            'flightClass.flight.destinationAirport',
        ])
        ->where('id', $bookingId)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        $ticketService = new TicketService();
        $ticket = $ticketService->createTicket($booking, $booking->payment->payment_method);

        return view('payments.success', compact('booking'));
    }
}
