<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::create([
            'user_id' => 1,
            'product_id' => 1,
            'rating' => 5,
            'comment' => 'Excellent laptop! Great performance and build quality.'
        ]);

        Review::create([
            'user_id' => 1,
            'product_id' => 2,
            'rating' => 4,
            'comment' => 'Good phone with amazing camera quality.'
        ]);

        Review::create([
            'user_id' => 1,
            'product_id' => 3,
            'rating' => 5,
            'comment' => 'Best headphones I have ever used. Great sound quality!'
        ]);

        Review::create([
            'user_id' => 1,
            'product_id' => 4,
            'rating' => 4,
            'comment' => 'Perfect tablet for work and entertainment.'
        ]);

        Review::create([
            'user_id' => 1,
            'product_id' => 5,
            'rating' => 3,
            'comment' => 'Good watch but battery life could be better.'
        ]);
    }
}
