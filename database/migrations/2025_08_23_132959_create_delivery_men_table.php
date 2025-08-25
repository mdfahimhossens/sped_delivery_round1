<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_men', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('vehicle_number')->nullable();
            $table->enum('status', ['available','busy','inactive'])->default('available'); // ✅ update
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_men'); // ✅ correct table
    }
};
