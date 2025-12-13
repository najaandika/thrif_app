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
        // 1. Create order_items table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 12, 2); // Unit price at time of purchase
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });

        // 2. Migrate existing Orders data to Order Items (Preserve Online Orders)
        // We assume existing orders have product_id and quantity.
        // Unit price = total_price / quantity (safeguard div by zero)
        $orders = DB::table('orders')->whereNotNull('product_id')->get();
        foreach ($orders as $order) {
            $qty = $order->quantity > 0 ? $order->quantity : 1;
            $unitPrice = $order->total_price / $qty;
            
            DB::table('order_items')->insert([
                'order_id' => $order->id,
                'product_id' => $order->product_id,
                'quantity' => $qty,
                'price' => $unitPrice,
                'subtotal' => $order->total_price,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ]);
        }

        // 3. Drop old transaction tables
        Schema::dropIfExists('transaction_items');
        Schema::dropIfExists('transactions');

        // 4. Alter orders table
        Schema::table('orders', function (Blueprint $table) {
            // Add new columns
            $table->enum('type', ['online', 'pos'])->default('online')->after('id');
            $table->decimal('amount_received', 12, 2)->nullable()->after('total_price');
            
            // Make columns nullable
            $table->string('buyer_name')->nullable()->change();
            $table->string('buyer_contact')->nullable()->change();
            $table->text('shipping_address')->nullable()->change();

            // Drop old columns (must drop FK first)
            $table->dropForeign(['product_id']);
            $table->dropColumn(['product_id', 'quantity']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreating this exactly is hard because of data loss in down(), 
        // but we try to restore structure.
        
        // 1. Revert orders table modifs
        Schema::table('orders', function (Blueprint $table) {
             // We cannot easily put product_id back with data without complex logic.
             // So we just add the columns back nullable first.
             $table->foreignId('product_id')->nullable()->constrained()->cascadeOnDelete();
             $table->unsignedInteger('quantity')->nullable();
             $table->string('buyer_name')->nullable(false)->change(); // Might fail if nulls exist
             $table->dropColumn(['type', 'amount_received']);
        });

        // 2. Restore transactions structure
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('total_qty')->nullable();
            $table->decimal('total_price', 12, 2);
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('qty');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });

        // 3. Drop order_items
        Schema::dropIfExists('order_items');
    }
};
