<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Assign permissions to roles
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo(Permission::all()); // Admin has all permissions

        $salesRole = Role::findByName('sales');
        $salesRole->givePermissionTo([
            'view industries',
            'view services',
            'view locations',
            'view reasons',
            'view sources',
        ]);

        $leaderRole = Role::findByName('leader');
        $leaderRole->givePermissionTo([
            'view industries',
            'view services',
            'view locations',
            'view reasons',
            'view sources',
            'create areas',
            'store areas',
        ]);
    }
}
