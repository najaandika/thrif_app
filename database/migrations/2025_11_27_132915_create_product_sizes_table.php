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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('size');
            // Kolom stock dihapus, tidak perlu ditambahkan lagi
            $table->timestamps();
        });

        // Migrate existing data
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            DB::table('product_sizes')->insert([
                'product_id' => $product->id,
                'size' => $product->size ?? 'All Size',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
