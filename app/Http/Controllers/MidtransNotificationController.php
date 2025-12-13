<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    public function handle(Request $request)
    {
        try {
            $notificationBody = json_decode($request->getContent(), true);

            // Log notification for debugging
            Log::info('Midtrans Notification:', $notificationBody);

            $orderId = $notificationBody['order_id'];
            $transactionStatus = $notificationBody['transaction_status'];
            $fraudStatus = $notificationBody['fraud_status'];

            // Format expected: TRX-{id}-{timestamp}
            // Start by assuming it might be a direct ID or the formatted string
            $segments = explode('-', $orderId);
            $realId = isset($segments[1]) && is_numeric($segments[1]) ? $segments[1] : $orderId;

            // Find the order
            $order = Order::find($realId);

            if (!$order) {
                // Log and try direct lookup just in case
                Log::warning("Order not found by ID parsing: $realId. Original: $orderId");
                $order = Order::where('id', $orderId)->first();
            }

            if (!$order) {
                Log::error("Order truly not found: $orderId");
                return response()->json(['message' => 'Order not found'], 404);
            }
            
            if ($order->status === 'paid') {
                return response()->json(['message' => 'Order already paid'], 200);
            }

            DB::beginTransaction();

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->update(['status' => 'pending']);
                } else {
                    $order->update(['status' => 'paid', 'paid_at' => now(), 'payment_status' => 'paid']);
                    $this->reduceStock($order);
                }
            } else if ($transactionStatus == 'settlement') {
                $order->update(['status' => 'paid', 'paid_at' => now(), 'payment_status' => 'paid']);
                $this->reduceStock($order);
            } else if ($transactionStatus == 'pending') {
                $order->update(['status' => 'pending']);
            } else if ($transactionStatus == 'deny') {
                $order->update(['status' => 'cancelled']);
            } else if ($transactionStatus == 'expire') {
                $order->update(['status' => 'cancelled']);
            } else if ($transactionStatus == 'cancel') {
                $order->update(['status' => 'cancelled']);
            }

            DB::commit();

            return response()->json(['message' => 'Notification processed'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    private function reduceStock($order)
    {
        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->is_available = false;
                $product->save();
            }
        }
    }
}
