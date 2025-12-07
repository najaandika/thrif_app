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
        Schema::table('customer_addresses', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['user_id']);
            
            // Drop columns
            $table->dropColumn([
                'user_id',
                'city',
                'province',
                'postal_code',
                'notes'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            // Restore columns
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            $table->string('city')->after('address_line')->nullable();
            $table->string('province')->after('city')->nullable();
            $table->string('postal_code')->after('province')->nullable();
            $table->text('notes')->after('postal_code')->nullable();
        });
    }
};
