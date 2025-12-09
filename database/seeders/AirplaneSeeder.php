<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AirplaneSeeder extends Seeder
{
    public function run()
    {
        $models = ['Boeing 737-800', 'Airbus A320', 'Boeing 777-300ER', 'Airbus A330', 'ATR 72-600'];

        for ($i = 0; $i < 10; $i++) {
            // Ambil ID maskapai secara acak
            $airlineId = DB::table('airlines')->inRandomOrder()->value('id');
            
            DB::table('airplanes')->insert([
                'airline_id' => $airlineId,
                'model' => $models[array_rand($models)], // Pilih model acak
                'total_capacity' => rand(150, 300),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}