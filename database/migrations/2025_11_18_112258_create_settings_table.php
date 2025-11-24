<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'shop_name', 'value' => 'Thrif', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'shop_logo', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'shop_tagline', 'value' => 'Your trusted thrift store', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'shop_email', 'value' => 'contact@thrif.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'shop_phone', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'shop_address', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
