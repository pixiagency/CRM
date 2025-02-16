<?php

namespace App\Models\Tenant;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends BaseModel
{

    protected $fillable=
    [
        'name',
        'phone',
        'email',
        'address',
        'city_id',
        'resource_id',
    ];

    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id');
    }

    // Contact belongs to a resource
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    // Contact has many leads
    public function leads()
    {
        return $this->hasMany(Lead::class,'contact_id');
    }
}
