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
        Schema::table('transaction_items', function (Blueprint $table) {
            // Drop the existing foreign key that cascades delete
            $table->dropForeign(['product_id']);
            
            // Make product_id nullable and set null on delete
            $table->foreignId('product_id')->nullable()->change()->constrained()->nullOnDelete();
            
            // Add product_name to store snapshot
            $table->string('product_name')->after('product_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropColumn('product_name');
            $table->dropForeign(['product_id']);
            $table->foreignId('product_id')->nullable(false)->change()->constrained()->cascadeOnDelete();
        });
    }
};
