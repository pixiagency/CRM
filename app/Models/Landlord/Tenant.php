<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    // $table = 'tenants';

    protected $fillable = ['name', 'domain', 'database', 'owner_id'];
    protected $with = ['owner'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
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
