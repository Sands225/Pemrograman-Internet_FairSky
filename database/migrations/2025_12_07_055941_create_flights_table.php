<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained('airlines');
            $table->foreignId('airplane_id')->constrained('airplanes');
            $table->string('flight_number', 10);

            $table->foreignId('origin_airport_id')->constrained('airports');
            $table->foreignId('destination_airport_id')->constrained('airports');

            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');

            $table->enum('status', ['Scheduled', 'Delayed', 'Cancelled', 'Landed'])->default('Scheduled');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
