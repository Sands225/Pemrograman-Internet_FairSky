<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->foreignId('booking_id')->constrained('bookings');
            $table->foreignId('passenger_id')->constrained('passengers');
            $table->foreignId('flight_id')->constrained('flights');
            $table->string('seat_number', 5)->nullable();
            $table->enum('class_type', ['Economy', 'Business', 'First']);
            $table->enum('eticket_status', ['Issued', 'CheckedIn', 'Boarded'])->default('Issued');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
