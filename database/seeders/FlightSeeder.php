<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 300; $i++) {
            // 1. Ambil 1 pesawat acak beserta pemiliknya (airline_id)
            $airplane = DB::table('airplanes')->inRandomOrder()->first();

            // 2. Ambil 2 bandara acak yang berbeda (Asal & Tujuan)
            $origin = DB::table('airports')->inRandomOrder()->first();
            $destination = DB::table('airports')->where('id', '!=', $origin->id)->inRandomOrder()->first();

            // 3. Tentukan waktu berangkat (mulai besok s/d 3 hari ke depan)
            $departure = Carbon::now()->addDays(rand(1, 3))->addHours(rand(1, 12));
            $arrival = (clone $departure)->addHours(rand(1, 7)); // Durasi terbang 1-7 jam

            DB::table('flights')->insert([
                'airline_id' => $airplane->airline_id, // Harus sama dengan pemilik pesawat
                'airplane_id' => $airplane->id,
                'flight_number' => 'FL-' . rand(100, 999),
                'origin_airport_id' => $origin->id,
                'destination_airport_id' => $destination->id,
                'departure_time' => $departure,
                'arrival_time' => $arrival,
                'status' => 'Scheduled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
