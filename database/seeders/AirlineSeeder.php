<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AirlineSeeder extends Seeder
{
    public function run()
    {
        $airlines = [
            ['code' => 'GA', 'name' => 'Garuda Indonesia'],
            ['code' => 'SQ', 'name' => 'Singapore Airlines'],
            ['code' => 'QZ', 'name' => 'Indonesia AirAsia'],
            ['code' => 'JT', 'name' => 'Lion Air'],
            ['code' => 'ID', 'name' => 'Batik Air'],
            ['code' => 'QG', 'name' => 'Citilink'],
            ['code' => 'MH', 'name' => 'Malaysia Airlines'],
            ['code' => 'EK', 'name' => 'Emirates'],
            ['code' => 'JL', 'name' => 'Japan Airlines'],
            ['code' => 'QR', 'name' => 'Qatar Airways'],
        ];

        foreach ($airlines as $airline) {
            DB::table('airlines')->insert([
                'airline_code' => $airline['code'],
                'airline_name' => $airline['name'],
                'logo_url' => 'https://via.placeholder.com/150?text=' . $airline['code'], // Dummy logo
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}