<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'stock' => fake()->numberBetween(0, 50),
            'image' => 'https://loremflickr.com/640/480/sneakers?lock=' . fake()->unique()->numberBetween(1, 1000),
            'category_id' => Category::inRandomOrder()->first()->id,
            'seller_id' => User::factory(),
        ];
    }
}
