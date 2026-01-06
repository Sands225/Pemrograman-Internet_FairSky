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
            ['code' => 'HLP', 'name' => 'Halim Perdanakusuma International Airport', 'city' => 'Jakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'DPS', 'name' => 'Ngurah Rai International Airport', 'city' => 'Denpasar', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'SUB', 'name' => 'Juanda International Airport', 'city' => 'Surabaya', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'KNO', 'name' => 'Kualanamu International Airport', 'city' => 'Medan', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'UPG', 'name' => 'Sultan Hasanuddin International Airport', 'city' => 'Makassar', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'YIA', 'name' => 'Yogyakarta International Airport', 'city' => 'Yogyakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'BDO', 'name' => 'Husein Sastranegara International Airport', 'city' => 'Bandung', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'SRG', 'name' => 'Jenderal Ahmad Yani International Airport', 'city' => 'Semarang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'SOC', 'name' => 'Adisumarmo International Airport', 'city' => 'Surakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'MLG', 'name' => 'Abdul Rachman Saleh Airport', 'city' => 'Malang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'JOG', 'name' => 'Adisutjipto International Airport', 'city' => 'Yogyakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'PLM', 'name' => 'Sultan Mahmud Badaruddin II International Airport', 'city' => 'Palembang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'PKU', 'name' => 'Sultan Syarif Kasim II International Airport', 'city' => 'Pekanbaru', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'PDG', 'name' => 'Minangkabau International Airport', 'city' => 'Padang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'BTH', 'name' => 'Hang Nadim International Airport', 'city' => 'Batam', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'TJP', 'name' => 'Raja Haji Fisabilillah Airport', 'city' => 'Tanjung Pinang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'PNK', 'name' => 'Supadio International Airport', 'city' => 'Pontianak', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'BPN', 'name' => 'Sultan Aji Muhammad Sulaiman Airport', 'city' => 'Balikpapan', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'TRK', 'name' => 'Juwata International Airport', 'city' => 'Tarakan', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'SAM', 'name' => 'Temindung Airport', 'city' => 'Samarinda', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'LOP', 'name' => 'Lombok International Airport', 'city' => 'Praya', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'KOE', 'name' => 'El Tari International Airport', 'city' => 'Kupang', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'LBJ', 'name' => 'Komodo International Airport', 'city' => 'Labuan Bajo', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'AMQ', 'name' => 'Pattimura International Airport', 'city' => 'Ambon', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'TTE', 'name' => 'Sultan Babullah Airport', 'city' => 'Ternate', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'SOQ', 'name' => 'Dominique Edward Osok Airport', 'city' => 'Sorong', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'MKW', 'name' => 'Rendani Airport', 'city' => 'Manokwari', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'DJJ', 'name' => 'Sentani International Airport', 'city' => 'Jayapura', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'TIM', 'name' => 'Moses Kilangin Airport', 'city' => 'Timika', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'WMX', 'name' => 'Wamena Airport', 'city' => 'Wamena', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'NBX', 'name' => 'Nabire Airport', 'city' => 'Nabire', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura'],
            ['code' => 'BTJ', 'name' => 'Sultan Iskandar Muda International Airport', 'city' => 'Banda Aceh', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'MEQ', 'name' => 'Cut Nyak Dhien Airport', 'city' => 'Meulaboh', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'TKG', 'name' => 'Radin Inten II Airport', 'city' => 'Bandar Lampung', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'PGK', 'name' => 'Depati Amir Airport', 'city' => 'Pangkal Pinang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'TJQ', 'name' => 'H.A.S. Hanandjoeddin Airport', 'city' => 'Tanjung Pandan', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta'],
            ['code' => 'GTO', 'name' => 'Djalaluddin Airport', 'city' => 'Gorontalo', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'MDC', 'name' => 'Sam Ratulangi International Airport', 'city' => 'Manado', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'PLU', 'name' => 'Mutiara SIS Al-Jufrie Airport', 'city' => 'Palu', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'KDI', 'name' => 'Haluoleo Airport', 'city' => 'Kendari', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            ['code' => 'BUW', 'name' => 'Betoambari Airport', 'city' => 'Baubau', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar'],
            // International
            ['code' => 'KUL', 'name' => 'Kuala Lumpur International Airport', 'city' => 'Kuala Lumpur', 'country' => 'Malaysia', 'is_international' => true, 'timezone' => 'Asia/Kuala_Lumpur'],
            ['code' => 'SIN', 'name' => 'Singapore Changi Airport', 'city' => 'Singapore', 'country' => 'Singapore','is_international' => true, 'timezone' => 'Asia/Singapore'],
            ['code' => 'BKK', 'name' => 'Suvarnabhumi Airport', 'city' => 'Bangkok', 'country' => 'Thailand','is_international' => true, 'timezone' => 'Asia/Bangkok'],
            ['code' => 'NRT', 'name' => 'Narita International Airport', 'city' => 'Tokyo', 'country' => 'Japan','is_international' => true, 'timezone' => 'Asia/Tokyo'],
            ['code' => 'ICN', 'name' => 'Incheon International Airport', 'city' => 'Seoul', 'country' => 'South Korea','is_international' => true, 'timezone' => 'Asia/Seoul'],
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
