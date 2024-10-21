<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Product::factory()->count(20)->create();

        $testOrders = Order::factory()->count(3)->create([
            'user_id' => $testUser->id
        ]);

        foreach ($testOrders as $order) {
            $products = Product::query()->inRandomOrder()->limit(rand(1, 6))->get();

            foreach ($products as $product) {
                OrderItem::factory()->create([
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'price' => $product->price,
                ]);
            }
        }
    }
}
