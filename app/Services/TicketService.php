<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketService
{
    public function createTicket(
        Booking $booking,
        string $paymentMethod
    ): Ticket {
        return DB::transaction(function () use ($booking, $paymentMethod) {

            Payment::create([
                'booking_id'     => $booking->id,
                'payment_method' => $paymentMethod,
                'amount'         => $booking->total_price,
                'payment_status' => 'paid',
                'paid_at'        => now(),
            ]);

            $booking->update([
                'status'         => 'confirmed',
                'payment_status' => 'Paid',
            ]);

            return Ticket::create([
                'booking_id'    => $booking->id,
                'ticket_number' => 'TKT-' . strtoupper(Str::random(10)),
                'issued_at'     => now(),
            ]);
        });
    }
}
