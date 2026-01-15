<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Booking::with('user')
            ->whereNotNull('payment_status')
            ->latest('booking_date')
            ->paginate(15);

        return view('admin.payments.index', compact('payments'));
    }

    public function markPaid(Booking $booking)
    {
        $booking->update([
            'payment_status' => 'Paid',
            'status' => 'confirmed',
        ]);

        return back()->with('success', 'Payment marked as Paid.');
    }
}
