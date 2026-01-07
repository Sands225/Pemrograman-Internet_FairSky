<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,

            // Master data seeders
            // import airline dulu untuk 
            AirlineSeeder::class,
            // import airline dulu untuk 
            AirportSeeder::class,

            // Operational data seeders
            // Pesawat butuh Airline
            AirplaneSeeder::class,  
            // Flight butuh Airline, Pesawat, dan Bandara
            FlightSeeder::class,    
            // FlightClass butuh Flight
            FlightClassSeeder::class, 

            // Transactional data seeders
            // Booking butuh User
            BookingSeeder::class,   
            // Passenger butuh Booking
            PassengerSeeder::class, 
            // Ticket butuh Booking, Passenger, dan Flight
            TicketSeeder::class,
            // Payment butuh Booking
            PaymentSeeder::class,

            // BookingAddon butuh Booking
            BookingAddonSeeder::class,
        ]);
    }
}
