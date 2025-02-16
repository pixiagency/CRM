<?php

namespace App\Models\Tenant;



class Stage extends BaseModel
{
    protected $fillable=['name','seq_number','pipline_id'];

    public function pipline(){
        return $this->belongsTo(Pipline::class);
    }
    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'lead_stage')
            ->withPivot('start_date', 'exit_date', 'pipline_id')
            ->withTimestamps();
    }

}
