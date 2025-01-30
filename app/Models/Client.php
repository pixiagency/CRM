<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use Filterable;
    protected $guarded=['id'];
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    // A client belongs to one city
    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id');
    }

    // A client can have many industries
    public function industries()
    {
        return $this->belongsToMany(Industry::class, 'client_industry');
    }

    // A client can have many services
    public function services()
    {
        return $this->belongsToMany(Service::class, 'client_service')
            ->withPivot('category_id'); // Include category_id in the pivot table
    }

    // A client can have many custom fields
    public function customFields()
    {
        return $this->belongsToMany(CustomField::class, 'client_custom_fields')
            ->withPivot('value'); // Include value in the pivot table
    }
}
