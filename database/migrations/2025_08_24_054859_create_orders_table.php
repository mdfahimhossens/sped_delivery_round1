<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('delivery_zone_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_delivery_man_id')->nullable()->constrained('delivery_men')->onDelete('set null');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('delivery_address')->nullable();
            $table->decimal('delivery_latitude', 10, 7);
            $table->decimal('delivery_longitude', 10, 7);
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->enum('status', ['pending','assigned','accepted','rejected','processing','delivered','cancelled'])->default('pending');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
