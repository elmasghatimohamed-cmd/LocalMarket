<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a cart for each user (except the first admin/moderator)
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'moderator']);
        })->get();

        foreach ($users as $user) {
            Cart::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
