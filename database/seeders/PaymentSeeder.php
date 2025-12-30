<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $bookings = DB::table('bookings')->get();

        if ($bookings->isEmpty()) {
            return;
        }

        foreach ($bookings as $booking) {

            // Random payment result
            $statuses = ['Paid', 'Failed'];
            $paymentStatus = $statuses[array_rand($statuses)];

            DB::transaction(function () use ($booking, $paymentStatus) {

                DB::table('payments')->insert([
                    'booking_id' => $booking->id,
                    'payment_method' => collect(['credit_card', 'paypal', 'bank_transfer'])->random(),
                    'amount' => $booking->total_price,
                    'payment_status' => $paymentStatus,
                    'transaction_code' => 'TXN-' . strtoupper(Str::random(10)),
                    'paid_at' => $paymentStatus === 'Paid' ? Carbon::now() : null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                // Sync booking payment status
                DB::table('bookings')
                    ->where('id', $booking->id)
                    ->update([
                        'payment_status' => $paymentStatus,
                        'status' => $paymentStatus === 'Paid' ? 'confirmed' : 'cancelled',
                        'updated_at' => Carbon::now(),
                    ]);
            });
        }
    }
}
