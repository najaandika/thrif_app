<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('customer_id')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();
        });

        Order::with('product')->chunkById(100, function ($orders) {
            foreach ($orders as $order) {
                if (! $order->customer_id) {
                    $order->customer_id = $order->user_id;
                }

                if ($order->product && $order->user_id !== $order->product->user_id) {
                    $order->user_id = $order->product->user_id;
                }

                $order->save();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('customer_id');
        });
    }
};
