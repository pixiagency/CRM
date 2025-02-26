<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Resource extends BaseModel
{
    protected $connection = 'tenant';
    protected $table = 'resources';
    protected $fillable=['name'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
