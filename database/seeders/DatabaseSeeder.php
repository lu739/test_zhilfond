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

        Order::factory()->count(3)->create([
            'user_id' => $testUser->id,
            'product_list' => Product::query()
                ->inRandomOrder()
                ->limit(rand(1, 6))
                ->pluck('name')
                ->implode(', '),
        ]);
    }
}
