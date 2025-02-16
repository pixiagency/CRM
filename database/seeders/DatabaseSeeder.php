<?php

namespace Database\Seeders;

use App\Models\Landlord\Tenant;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Tenant::checkCurrent()
            ? $this->runTenantSpecificSeeders()
            : $this->runLandlordSpecificSeeders();
    }

    public function runTenantSpecificSeeders()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
        ]);
    }

    public function runLandlordSpecificSeeders()
    {
        $this->call(CreateTestTenantSeeder::class);
    }
}
