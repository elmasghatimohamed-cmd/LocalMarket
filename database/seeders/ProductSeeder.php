<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop',
            'description' => 'High-performance laptop',
            'price' => 999.99,
            'stock' => 10,
            'seller_id' => 1,
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Phone',
            'description' => 'Smartphone with great camera',
            'price' => 599.99,
            'stock' => 25,
            'seller_id' => 1,
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Headphones',
            'description' => 'Wireless noise-canceling headphones',
            'price' => 199.99,
            'stock' => 15,
            'seller_id' => 1,
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Tablet',
            'description' => '10-inch tablet for work and entertainment',
            'price' => 399.99,
            'stock' => 8,
            'seller_id' => 1,
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Watch',
            'description' => 'Smart watch with fitness tracking',
            'price' => 299.99,
            'stock' => 12,
            'seller_id' => 1,
            'category_id' => 1
        ]);
    }
}
