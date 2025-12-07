<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('booking_code', 8)->unique();
            $table->timestamp('booking_date')->useCurrent();
            $table->decimal('total_price', 15, 2);
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed', 'Refunded'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
