<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('airport_code', 3)->unique();
            $table->string('airport_name', 100);
            $table->string('city', 50);
            $table->string('country', 50);
            $table->string('timezone', 50)->default('Asia/Jakarta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
