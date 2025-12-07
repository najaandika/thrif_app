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
        Schema::table('categories', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['user_id']);
            
            // Drop columns
            $table->dropColumn([
                'user_id',
                'slug',
                'description',
                'icon',
                'color'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Restore columns
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            $table->string('slug')->after('name')->unique();
            $table->text('description')->after('slug')->nullable();
            $table->string('icon')->after('description')->nullable();
            $table->string('color')->after('icon')->default('#6366f1');
        });
    }
};
