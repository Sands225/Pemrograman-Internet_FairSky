<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AirplaneSeeder extends Seeder
{
    public function run()
    {
        $models = [
            'Boeing 737-800',
            'Airbus A320',
            'Boeing 777-300ER',
            'Airbus A330',
            'Boeing 737-900ER',
            'Airbus A350-900',
            'Airbus A319',
            'Airbus A321neo',
            'Boeing 737 MAX 8',
            ];

        for ($i = 0; $i < 120; $i++) {
            // Ambil ID maskapai secara acak
            $airlineId = DB::table('airlines')->inRandomOrder()->value('id');

            DB::table('airplanes')->insert([
                'airline_id' => $airlineId,
                'model' => $models[array_rand($models)], // Pilih model acak
                'total_capacity' => rand(124, 440),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
