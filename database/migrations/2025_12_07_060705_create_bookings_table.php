<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // RELATIONS
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('flight_id')->constrained('flights')->cascadeOnDelete();
            $table->foreignId('flight_class_id')->constrained('flight_classes')->cascadeOnDelete();

            // BOOKING INFO
            $table->string('booking_code', 20)->unique();
            $table->string('passenger_name');
            $table->string('passenger_phone', 20);

            // PAYMENT & STATUS
            $table->decimal('total_price', 15, 2);
            $table->enum('status', ['confirmed', 'cancelled', 'pending'])->default('confirmed');
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed', 'Refunded'])->default('Pending');

            $table->timestamp('booking_date')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
