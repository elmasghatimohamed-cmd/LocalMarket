<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'moderator']);
        })->get();

        foreach ($users->random(min(5, $users->count())) as $user) {
            Order::create([
                'user_id' => $user->id,
                'total' => rand(10, 500),
                'status' => collect(['on_hold', 'paid', 'delivered'])->random(),
                'payment_status' => collect(['pending', 'completed', 'failed'])->random(),
            ]);
        }
    }
}
