<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Location extends Model
{
    use HasFactory, NodeTrait, Filterable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'status', '_lft', '_lgt', 'parent_id'];

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }

    public function areas()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function city()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }
}
