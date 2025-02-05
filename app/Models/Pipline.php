<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Pipline extends Model
{
    use Filterable;
    protected $fillable=['name'];

    public function stages(){
        return $this->hasMany(Stage::class);
    }

}
