<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        if ($products->isEmpty() || $orders->isEmpty()) {
            return;
        }

        foreach ($orders as $order) {
            $randomProducts = $products->random(min(3, $products->count()));
            $total = 0;
            
            foreach ($randomProducts as $product) {
                $quantity = rand(1, 5);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);

                $total += $quantity * $product->price;
            }

            // Update order total
            $order->update(['total' => $total]);
        }
    }
}
