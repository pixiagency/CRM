<?php

namespace App\Models\Tenant;


class Category extends BaseModel
{

    protected $fillable = ['name', 'service_id', 'price'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
