<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    use Filterable;
    protected $fillable=
    [
        'name',
        'type',
        'options',
    ];

    protected $casts = [
        'options' => 'array', // Cast JSON to array
    ];
}
