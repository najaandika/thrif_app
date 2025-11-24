<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('distance_km', 8, 2)->nullable()->after('quantity');
            $table->decimal('shipping_cost', 12, 2)->nullable()->after('distance_km');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['distance_km', 'shipping_cost']);
        });
    }
};
