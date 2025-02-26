<?php

namespace App\Models\Tenant;


use Illuminate\Database\Eloquent\Model;

class Reason extends BaseModel
{
    protected $connection = 'tenant';
    protected $fillable=['name'];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
