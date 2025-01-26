<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class CustomFieldFilters extends QueryFilter
{
    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function name($term)
    {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }

    public function type($term)
    {
        return $this->builder->where('type','LIKE', "%$term%");
    }

    public function options($term)
    {
        return $this->builder->whereJsonContains('options', $term);
    }

    public function created_at($start, $end = null)
    {
        if ($end) {
            return $this->builder->whereBetween('created_at', [$start, $end]);
        }
        return $this->builder->whereDate('created_at', $start);
    }
}
