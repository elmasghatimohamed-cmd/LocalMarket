<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = Category::insert([
            ['name' => 'Electronics', 'description' => 'Electronic items'],
            ['name' => 'Fashion', 'description' => 'Clothing and accessories'],
            ['name' => 'Home', 'description' => 'Home products'],
            ['name' => 'Sports', 'description' => 'Sports equipment'],
        ]);

        Product::factory(20)->create();
    }
}
