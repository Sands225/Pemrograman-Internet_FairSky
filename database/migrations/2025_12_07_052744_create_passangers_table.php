<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id('passenger_id');
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->string('full_name', 100);
            $table->string('identity_number', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
