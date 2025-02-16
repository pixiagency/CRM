<?php

namespace Database\Seeders;

use App\Models\Landlord\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CreateTestTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = sprintf('pixi %s', config('app.env'));
        $tenant = Tenant::query()->create([
            'name' => $name,
            'domain' => Str::slug($name),
        ]);

        $tenant->makeCurrent();
        // Migrate the tenant's database
        //php artisan tenants:artisan "migrate --database=tenant --seed"
        $tenant_id = $tenant->id;
        Artisan::call(command: "tenants:artisan --tenant=$tenant_id 'migrate --database=tenant --seed'");
    }
}
