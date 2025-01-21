<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use Filterable;
    protected $fillable=['name'];
}
