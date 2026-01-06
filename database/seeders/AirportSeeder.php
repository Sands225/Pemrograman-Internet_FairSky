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
            ['code' => 'CGK', 'name' => 'Soekarno-Hatta International Airport', 'city' => 'Jakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'HLP', 'name' => 'Halim Perdanakusuma International Airport', 'city' => 'Jakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'DPS', 'name' => 'Ngurah Rai International Airport', 'city' => 'Denpasar', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'SUB', 'name' => 'Juanda International Airport', 'city' => 'Surabaya', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'KNO', 'name' => 'Kualanamu International Airport', 'city' => 'Medan', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'UPG', 'name' => 'Sultan Hasanuddin International Airport', 'city' => 'Makassar', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'YIA', 'name' => 'Yogyakarta International Airport', 'city' => 'Yogyakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'BDO', 'name' => 'Husein Sastranegara International Airport', 'city' => 'Bandung', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'SRG', 'name' => 'Jenderal Ahmad Yani International Airport', 'city' => 'Semarang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'SOC', 'name' => 'Adisumarmo International Airport', 'city' => 'Surakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'MLG', 'name' => 'Abdul Rachman Saleh Airport', 'city' => 'Malang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'JOG', 'name' => 'Adisutjipto International Airport', 'city' => 'Yogyakarta', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'PLM', 'name' => 'Sultan Mahmud Badaruddin II International Airport', 'city' => 'Palembang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'PKU', 'name' => 'Sultan Syarif Kasim II International Airport', 'city' => 'Pekanbaru', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'PDG', 'name' => 'Minangkabau International Airport', 'city' => 'Padang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'BTH', 'name' => 'Hang Nadim International Airport', 'city' => 'Batam', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'TJP', 'name' => 'Raja Haji Fisabilillah Airport', 'city' => 'Tanjung Pinang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'PNK', 'name' => 'Supadio International Airport', 'city' => 'Pontianak', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'BPN', 'name' => 'Sultan Aji Muhammad Sulaiman Airport', 'city' => 'Balikpapan', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'TRK', 'name' => 'Juwata International Airport', 'city' => 'Tarakan', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'SAM', 'name' => 'Temindung Airport', 'city' => 'Samarinda', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'LOP', 'name' => 'Lombok International Airport', 'city' => 'Praya', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'KOE', 'name' => 'El Tari International Airport', 'city' => 'Kupang', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'LBJ', 'name' => 'Komodo International Airport', 'city' => 'Labuan Bajo', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'AMQ', 'name' => 'Pattimura International Airport', 'city' => 'Ambon', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'TTE', 'name' => 'Sultan Babullah Airport', 'city' => 'Ternate', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'SOQ', 'name' => 'Dominique Edward Osok Airport', 'city' => 'Sorong', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'MKW', 'name' => 'Rendani Airport', 'city' => 'Manokwari', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'DJJ', 'name' => 'Sentani International Airport', 'city' => 'Jayapura', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'TIM', 'name' => 'Moses Kilangin Airport', 'city' => 'Timika', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'WMX', 'name' => 'Wamena Airport', 'city' => 'Wamena', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'NBX', 'name' => 'Nabire Airport', 'city' => 'Nabire', 'country' => 'Indonesia', 'timezone' => 'Asia/Jayapura', 'is_international' => false],
            ['code' => 'BTJ', 'name' => 'Sultan Iskandar Muda International Airport', 'city' => 'Banda Aceh', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'MEQ', 'name' => 'Cut Nyak Dhien Airport', 'city' => 'Meulaboh', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'TKG', 'name' => 'Radin Inten II Airport', 'city' => 'Bandar Lampung', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'PGK', 'name' => 'Depati Amir Airport', 'city' => 'Pangkal Pinang', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'TJQ', 'name' => 'H.A.S. Hanandjoeddin Airport', 'city' => 'Tanjung Pandan', 'country' => 'Indonesia', 'timezone' => 'Asia/Jakarta', 'is_international' => false],
            ['code' => 'GTO', 'name' => 'Djalaluddin Airport', 'city' => 'Gorontalo', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'MDC', 'name' => 'Sam Ratulangi International Airport', 'city' => 'Manado', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'PLU', 'name' => 'Mutiara SIS Al-Jufrie Airport', 'city' => 'Palu', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'KDI', 'name' => 'Haluoleo Airport', 'city' => 'Kendari', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            ['code' => 'BUW', 'name' => 'Betoambari Airport', 'city' => 'Baubau', 'country' => 'Indonesia', 'timezone' => 'Asia/Makassar', 'is_international' => false],
            // International
            ['code' => 'KUL', 'name' => 'Kuala Lumpur International Airport', 'city' => 'Kuala Lumpur', 'country' => 'Malaysia', 'timezone' => 'Asia/Kuala_Lumpur' ,'is_international' => true],
            ['code' => 'SIN', 'name' => 'Singapore Changi Airport', 'city' => 'Singapore', 'country' => 'Singapore', 'timezone' => 'Asia/Singapore' ,'is_international' => true],
            ['code' => 'BKK', 'name' => 'Suvarnabhumi Airport', 'city' => 'Bangkok', 'country' => 'Thailand', 'timezone' => 'Asia/Bangkok' ,'is_international' => true],
            ['code' => 'NRT', 'name' => 'Narita International Airport', 'city' => 'Tokyo', 'country' => 'Japan', 'timezone' => 'Asia/Tokyo' ,'is_international' => true],
            ['code' => 'ICN', 'name' => 'Incheon International Airport', 'city' => 'Seoul', 'country' => 'South Korea', 'timezone' => 'Asia/Seoul' ,'is_international' => true],
        ];

        foreach ($airports as $airport) {
            DB::table('airports')->insert([
                'airport_code' => $airport['code'],
                'airport_name' => $airport['name'],
                'city' => $airport['city'],
                'country' => $airport['country'],
                'timezone' => $airport['timezone'],
                'is_international' => $airport['is_international'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
