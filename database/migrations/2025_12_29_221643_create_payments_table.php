<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                  ->constrained('bookings')
                  ->onDelete('cascade');

            $table->string('payment_method', 50);
            $table->decimal('amount', 10, 2);

            $table->enum('payment_status', [
                'PENDING',
                'SUCCESS',
                'FAILED'
            ])->default('PENDING');

            $table->string('transaction_code')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
