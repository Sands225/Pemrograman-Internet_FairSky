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
        // Ambil ID User acak (selain admin)
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Jika tidak ada user lain, pakai ID 1 (admin) sebagai fallback
        if (empty($userIds)) $userIds = [1];

        for ($i = 0; $i < 10; $i++) {
            DB::table('bookings')->insert([
                'user_id' => $userIds[array_rand($userIds)],
                'booking_code' => strtoupper(Str::random(6)), // Generate kode unik 6 digit
                'booking_date' => Carbon::now(),
                'total_price' => 0, // Nanti diupdate otomatis oleh TicketSeeder
                'payment_status' => 'Paid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}