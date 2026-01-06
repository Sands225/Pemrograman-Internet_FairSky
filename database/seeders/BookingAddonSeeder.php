<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingAddon;
use App\Models\Booking;

class BookingAddonSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua booking ID yang ada
        $bookingIds = Booking::pluck('id');

        // Kalau belum ada booking, hentikan (biar tidak error FK)
        if ($bookingIds->isEmpty()) {
            $this->command->warn('No bookings found. BookingAddonSeeder skipped.');
            return;
        }

        $addons = [
            [
                'type' => 'insurance',
                'label' => 'Travel Insurance',
                'price' => 50000,
                'quantity' => 1,
            ],
            [
                'type' => 'baggage',
                'label' => 'Extra Baggage 10kg',
                'price' => 75000,
                'quantity' => 1,
            ],
            [
                'type' => 'meal',
                'label' => 'In-flight Meal',
                'price' => 35000,
                'quantity' => 1,
            ],
            [
                'type' => 'seat_selection',
                'label' => 'Preferred Seat',
                'price' => 25000,
                'quantity' => 1,
            ],
            [
                'type' => 'other',
                'label' => 'Carbon Offset',
                'price' => 20000,
                'quantity' => 1,
            ],
        ];

        foreach ($bookingIds as $bookingId) {
            // Setiap booking dapat 1–3 addon random
            $selected = collect($addons)->random(rand(1, 3));

            foreach ($selected as $addon) {
                BookingAddon::create([
                    'booking_id' => $bookingId,
                    'type' => $addon['type'],
                    'label' => $addon['label'],
                    'price' => $addon['price'],
                    'quantity' => $addon['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
