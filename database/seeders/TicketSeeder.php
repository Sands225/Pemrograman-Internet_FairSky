<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $bookings = DB::table('bookings')->get();

        foreach ($bookings as $booking) {

            // Get flight class for price & class type
            $flightClass = DB::table('flight_classes')
                ->where('id', $booking->flight_class_id)
                ->first();

            if (!$flightClass) {
                continue; // skip broken data
            }

            DB::table('tickets')->insert([
                'booking_id'     => $booking->id,
                'ticket_number'  => 'TKT-' . strtoupper(Str::random(10)),
                'seat_number'    => rand(1, 30) . collect(['A','B','C','D','E','F'])->random(),
                'class_type'     => $flightClass->class_type,
                'eticket_status' => 'Issued',
                'issued_at'      => Carbon::now(),
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ]);

            // Ensure booking price matches flight class
            DB::table('bookings')
                ->where('id', $booking->id)
                ->update([
                    'total_price' => $flightClass->price
                ]);
        }
    }
}
