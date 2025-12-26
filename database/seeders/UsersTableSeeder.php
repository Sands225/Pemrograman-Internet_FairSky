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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'sandi@fair-sky.com',
                'password' => Hash::make('sandi123'),
                'full_name' => 'Sandi',
                'phone_number' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
