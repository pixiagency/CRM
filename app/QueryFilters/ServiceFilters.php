<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class ServiceFilters extends QueryFilter{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function name($term)
    {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }

    public function min_price($price)
    {
        return $this->builder->where('price', '>=', $price);
    }

    public function max_price($price)
    {
        return $this->builder->where('price', '<=', $price);
    }
    public function price_range($range)
    {
        [$min, $max] = explode(',', $range);
        return $this->builder->whereBetween('price', [$min, $max]);
    }

    
    public function created_at($date)
    {
        return $this->builder->whereDate('created_at', $date);
    }

}
