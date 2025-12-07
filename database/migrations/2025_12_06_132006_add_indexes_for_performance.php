<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Index for filtering by status (used in Orders/Index.php line 116)
            $table->index('status');
            
            // Index for filtering by payment_method (used in Orders/Index.php line 117)
            $table->index('payment_method');
            
            // Composite index for user_id + status (common query pattern)
            $table->index(['user_id', 'status']);
        });

        Schema::table('products', function (Blueprint $table) {
            // Index for filtering available products
            $table->index('is_available');
            
            // Index for category filtering (used in search)
            $table->index('category');
            
            // Composite index for user_id + is_available (dashboard queries)
            $table->index(['user_id', 'is_available']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['payment_method']);
            $table->dropIndex(['user_id', 'status']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['is_available']);
            $table->dropIndex(['category']);
            $table->dropIndex(['user_id', 'is_available']);
        });
    }
};
