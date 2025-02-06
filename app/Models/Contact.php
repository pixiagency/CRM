<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Filterable;
    protected $fillable=
    [
        'name',
        'phone',
        'email',
        'address',
        'city_id',
    ];
    
    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id');
    }
}
