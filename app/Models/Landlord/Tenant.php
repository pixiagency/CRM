<?php

namespace App\Models\Landlord;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    protected $fillable = ['name', 'domain', 'database'];

    protected static function booted()
    {
        static::creating(function (self $tenant) {
            if (empty($tenant->database)) {
                $tenant->database = Str::ulid();
            }
        });

        static::created(function (self $tenant) {
            $tenant->createDatabase();
        });
    }

    public function createDatabase(): bool
    {
        $config = config('database.connections.tenant');

        $create = "CREATE DATABASE IF NOT EXISTS `$this->database`
            DEFAULT CHARACTER SET {$config['charset']}
            DEFAULT COLLATE {$config['collation']}";

        return //DB::connection('mysql')->statement($user)
            DB::connection('landlord')->statement($create);
    }
}
