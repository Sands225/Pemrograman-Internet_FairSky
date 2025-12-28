<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@fair-sky.com',
                'password' => Hash::make('admin123'),
                'full_name' => 'Admin User',
                'phone_number' => '081234567890',
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'sandi@fair-sky.com',
                'password' => Hash::make('sandi123'),
                'full_name' => 'Sandi',
                'phone_number' => null,
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
              'email' => 'agungpurnama100@lele.com',
              'password' => Hash::make('L3L3_AkU_sUk4_G|t4'),
              'full_name' => 'AgUnG',
              'phone_number' => '081337537750',
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
