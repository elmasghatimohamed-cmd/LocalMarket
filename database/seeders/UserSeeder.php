<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin LocalMart',
                'email' => 'admin@localmart.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Modérateur Flux',
                'email' => 'mod@localmart.com',
                'role' => 'moderator',
            ],
            [
                'name' => 'Vendeur Pro',
                'email' => 'seller@localmart.com',
                'role' => 'seller',
            ],
            [
                'name' => 'Client Fidèle',
                'email' => 'client@localmart.com',
                'role' => 'client',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password123'),
                ]
            );

            $user->syncRoles([$userData['role']]);
        }
    }
}