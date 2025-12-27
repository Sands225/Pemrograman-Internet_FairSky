<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $flightClassIds = DB::table('flight_classes')->pluck('id')->toArray();

        // Safety fallback
        if (empty($userIds) || empty($flightClassIds)) {
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('bookings')->insert([
                'user_id' => $userIds[array_rand($userIds)],
                'flight_class_id' => $flightClassIds[array_rand($flightClassIds)],

                'booking_code' => strtoupper(Str::random(8)),
                'passenger_name' => 'Passenger ' . ($i + 1),
                'passenger_phone' => '08' . rand(1000000000, 9999999999),

                'total_price' => rand(500000, 3000000),
                'status' => 'confirmed',
                'payment_status' => 'Paid',

                'booking_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
