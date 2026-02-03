<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view products',
            'create products',
            'edit products',
            'delete products',
            'publish products',
            'view orders',
            'manage orders',
            'cancel orders',
            'manage users',
            'manage roles',
            'moderate comments',
            'block users',
            'view dashboard',
            'view reports'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web'])
            ->syncPermissions(['view products', 'view orders']);

        Role::firstOrCreate(['name' => 'seller', 'guard_name' => 'web'])
            ->syncPermissions([
                'view products',
                'create products',
                'edit products',
                'delete products',
                'view orders',
                'manage orders',
                'view dashboard'
            ]);

        Role::firstOrCreate(['name' => 'moderator', 'guard_name' => 'web'])
            ->syncPermissions(['view products', 'moderate comments', 'block users']);

        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web'])
            ->syncPermissions(Permission::all());
    }
}