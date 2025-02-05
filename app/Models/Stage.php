<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use Filterable;
    protected $fillable=['name','seq_number','pipline_id'];

    public function pipline(){
        return $this->belongsTo(Pipline::class);
    }
}
