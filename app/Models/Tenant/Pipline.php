<?php

namespace App\Models\Tenant;



class Pipline extends BaseModel
{
    protected $fillable=['name'];

    public function stages(){
        return $this->hasMany(Stage::class);
    }

}
