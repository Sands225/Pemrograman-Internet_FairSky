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
        // Ambil semua booking
        $bookings = DB::table('bookings')->get();

        foreach ($bookings as $booking) {
            // 1. Ambil Data Penumpang untuk booking ini
            $passengers = DB::table('passengers')->where('booking_id', $booking->id)->get();

            // 2. Pilih 1 Penerbangan Random yang punya kelas kursi tersedia
            // Kita join ke flight_classes untuk ambil harga sekalian
            $flightClass = DB::table('flight_classes')
                ->join('flights', 'flight_classes.flight_id', '=', 'flights.id')
                ->select('flight_classes.*', 'flights.flight_number')
                ->inRandomOrder()
                ->first();

            $totalPrice = 0;

            // 3. Buat Tiket untuk setiap penumpang
            foreach ($passengers as $passenger) {
                DB::table('tickets')->insert([
                    'booking_id' => $booking->id,
                    'passenger_id' => $passenger->id,
                    'flight_id' => $flightClass->flight_id,
                    'seat_number' => rand(1, 30) . ['A', 'B', 'C', 'D', 'E', 'F'][rand(0, 5)], // Contoh: 12A
                    'class_type' => $flightClass->class_type,
                    'eticket_status' => 'Issued',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                // Hitung total harga
                $totalPrice += $flightClass->price;
            }

            // 4. UPDATE Booking Total Price
            // Supaya datanya konsisten (Booking Price = Sum of Ticket Prices)
            DB::table('bookings')
                ->where('id', $booking->id)
                ->update(['total_price' => $totalPrice]);
        }
    }
}