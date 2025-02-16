<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Resource extends BaseModel
{
    protected $fillable=['name'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
