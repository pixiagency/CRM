<?php

namespace App\Models\Tenant;


use Illuminate\Database\Eloquent\Model;

class CustomField extends BaseModel
{

    protected $fillable=
    [
        'name',
        'type',
        'options',
    ];

    protected $casts = [
        'options' => 'array', // Cast JSON to array
    ];

    // A custom field can belong to many clients
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_custom_fields')
            ->withPivot('value');
    }

    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'lead_custom_fields')
            ->withPivot('value');
    }
}
