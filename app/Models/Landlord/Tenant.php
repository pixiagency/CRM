<?php

namespace App\Models\Landlord;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Model;

class Tenant extends BaseTenant
{
    use HasFactory;

    protected $connection = 'landlord';
    protected $fillable = ['name', 'domain', 'database', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    protected static function booted()
    {
        static::creating(function (self $tenant) {
            if (empty($tenant->database)) {
                $tenant->database = Str::ulid();
            }
        });

        static::created(function (self $tenant) {
            $tenant->createDatabase();
            // $tenant->runMigrations();
        });
    }

    public function createDatabase(): bool
    {
        $config = config('database.connections.tenant');

        $create = "CREATE DATABASE IF NOT EXISTS `$this->database`
            DEFAULT CHARACTER SET {$config['charset']}
            DEFAULT COLLATE {$config['collation']}";

        return DB::connection('landlord')->statement($create);
    }

    // public function runMigrations(): void
    // {
    //     // Switch to the tenant's database connection
    //     config(['database.connections.tenant.database' => $this->database]);
    //     DB::purge('tenant');

    //     // Run the migrations for the tenant
    //     Artisan::call('migrate', [
    //         '--database' => 'tenant',
    //         '--path' => 'database/migrations', // Path to tenant-specific migrations
    //         '--force' => true,
    //     ]);
    // }
}
