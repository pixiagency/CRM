<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;


class ReasonFilters extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function name($term)
    {
        return $this->builder->where('name', "LIKE", "%$term%");
    }
    // Add more filter methods as needed
    public function status($status)
    {
        return $this->builder->where('status', $status);
    }

    // Example: Filter by date range
    public function dateRange($dateRange)
    {
        $dates = explode(' - ', $dateRange);
        return $this->builder->whereBetween('created_at', [$dates[0], $dates[1]]);
    }
}

