<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'moderator']);
        })->get();
        
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $likedProducts = $products->random(min(5, $products->count()));
            
            foreach ($likedProducts as $product) {
                Like::firstOrCreate([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
