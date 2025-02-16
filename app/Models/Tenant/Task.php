<?php
namespace App\Models\Tenant;


class Task extends BaseModel
{
    protected $fillable = ['title', 'description', 'status', 'due_date'];

    public function leads()
    {
        return $this->belongsToMany(Lead::class)->withPivot('weight');
    }
}
