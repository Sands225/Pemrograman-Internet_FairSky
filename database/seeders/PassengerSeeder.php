<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PassengerSeeder extends Seeder
{
    public function run()
    {
        // Ambil 10 booking yang baru dibuat
        $bookings = DB::table('bookings')->get();

        $names = ['Budi Santoso', 'Siti Aminah', 'Andi Pratama', 'Dewi Lestari', 'Eko Kurniawan', 'Fajar Nugraha', 'Gita Gutawa', 'Hadi Wijaya', 'Indah Permata', 'Joko Anwar'];

        foreach ($bookings as $index => $booking) {
            DB::table('passengers')->insert([
                'booking_id' => $booking->id,
                'full_name' => $names[$index] ?? 'Penumpang ' . $index,
                'identity_number' => '32010' . rand(1000000000, 9999999999), // NIK palsu
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}