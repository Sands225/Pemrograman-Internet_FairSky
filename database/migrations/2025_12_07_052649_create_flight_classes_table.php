<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flight_classes', function (Blueprint $table) {
            $table->id('class_id');
            $table->foreignId('flight_id')->constrained('flights')->cascadeOnDelete();
            $table->enum('class_type', ['Economy', 'Business', 'First']);
            $table->decimal('price', 15, 2);
            $table->integer('quota');
            $table->integer('available_seats');
            $table->unique(['flight_id', 'class_type']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_classes');
    }
};
