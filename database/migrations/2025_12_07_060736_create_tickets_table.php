<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->string('ticket_number')->unique();
            $table->string('seat_number', 5)->nullable();

            $table->enum('class_type', ['Economy', 'Business', 'First']);

            $table->enum('eticket_status', ['Issued', 'CheckedIn', 'Boarded'])
                  ->default('Issued');

            $table->timestamp('issued_at');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
