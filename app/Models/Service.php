<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Filterable;
    protected $fillable = ['name','price'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
