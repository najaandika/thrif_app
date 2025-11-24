<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('base_distance_km', 8, 2)->default(3); // jarak dasar
            $table->decimal('base_price', 12, 2)->default(0); // ongkir untuk jarak <= base_distance_km
            $table->decimal('price_per_km', 12, 2)->default(0); // ongkir per km di atas base_distance_km
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_settings');
    }
};
