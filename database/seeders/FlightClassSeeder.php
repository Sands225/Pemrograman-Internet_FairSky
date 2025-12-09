<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightClassSeeder extends Seeder
{
    public function run()
    {
        // Kita butuh data Flight beserta info kapasitas Pesawat-nya
        // Jadi kita join ke tabel airplanes
        $flights = DB::table('flights')
            ->join('airplanes', 'flights.airplane_id', '=', 'airplanes.id')
            ->select('flights.id as flight_id', 'airplanes.total_capacity')
            ->limit(10) // Ambil 10 penerbangan yang sudah dibuat
            ->get();

        foreach ($flights as $flight) {
            $capacity = $flight->total_capacity;
            
            // SKENARIO: Membagi kursi pesawat
            // 20% untuk Business Class (dibulatkan ke bawah)
            $businessQuota = floor($capacity * 0.2); 
            // Sisanya untuk Economy Class
            $economyQuota = $capacity - $businessQuota;

            // 1. INPUT DATA KELAS BUSINESS
            if ($businessQuota > 0) {
                DB::table('flight_classes')->insert([
                    'flight_id' => $flight->flight_id,
                    'class_type' => 'Business',
                    'price' => rand(2500000, 4000000), // Harga mahal
                    'quota' => $businessQuota,
                    'available_seats' => $businessQuota,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            // 2. INPUT DATA KELAS ECONOMY
            if ($economyQuota > 0) {
                DB::table('flight_classes')->insert([
                    'flight_id' => $flight->flight_id,
                    'class_type' => 'Economy',
                    'price' => rand(800000, 1500000), // Harga standar
                    'quota' => $economyQuota,
                    'available_seats' => $economyQuota,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}