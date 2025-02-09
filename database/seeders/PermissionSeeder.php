<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions for each resource
        $resources = [
            'industries',
            'services',
            'locations',
            'reasons',
            'sources',
            'customFields',
            'piplines',
            'clients',
            'contacts',
            'opportunities',
            'role-permissions',
        ];

        $actions = [
            'view',
            // 'show',
            'create',
            'edit',
            'delete',
        ];
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                Permission::create(['name' => "{$action} {$resource}"]);
            }
        }

        Permission::create(['name' => 'create areas']);
        Permission::create(['name' => 'store areas']);

    }

}
