<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AirportSeeder extends Seeder
{
    public function run()
    {
        $airports = [
            ['code' => 'CGK', 'name' => 'Soekarno-Hatta International Airport', 'city' => 'Jakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'DPS', 'name' => 'Ngurah Rai International Airport', 'city' => 'Denpasar', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'SUB', 'name' => 'Juanda International Airport', 'city' => 'Surabaya', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'KNO', 'name' => 'Kualanamu International Airport', 'city' => 'Medan', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'UPG', 'name' => 'Sultan Hasanuddin International Airport', 'city' => 'Makassar', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'SIN', 'name' => 'Changi Airport', 'city' => 'Singapore', 'country' => 'Singapore', 'timezone' => 'Asia/Singapore'],
            ['code' => 'KUL', 'name' => 'Kuala Lumpur International Airport', 'city' => 'Kuala Lumpur', 'country' => 'Malaysia', 'timezone' => 'Asia/Kuala_Lumpur'],
            ['code' => 'HND', 'name' => 'Haneda Airport', 'city' => 'Tokyo', 'country' => 'Japan', 'timezone' => 'Asia/Tokyo'],
            ['code' => 'DXB', 'name' => 'Dubai International Airport', 'city' => 'Dubai', 'country' => 'United Arab Emirates', 'timezone' => 'Asia/Dubai'],
            ['code' => 'YIA', 'name' => 'Yogyakarta International Airport', 'city' => 'Yogyakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
        ];

        foreach ($airports as $airport) {
            DB::table('airports')->insert([
                'airport_code' => $airport['code'],
                'airport_name' => $airport['name'],
                'city' => $airport['city'],
                'country' => $airport['country'],
                'timezone' => $airport['timezone'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}