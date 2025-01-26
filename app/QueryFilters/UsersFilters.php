<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class UsersFilters extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function email($term)
    {
        return $this->builder->where('email',$term);
    }
    public function phone($term)
    {
        return $this->builder->where('phone',$term);
    }
    public function status($term)
    {
        return $this->builder->where('status',$term);
    }
    public function type($term)
    {
        return $this->builder->where('type',$term);
    }

    public function city_id($term)
    {
        return $this->builder->where('city_id',$term);
    }

    public function area_id($term){
        return $this->builder->where('area_id',$term);
    }
    public function company_id($term){
        return $this->builder->where('company_id',$term);
    }
    public function branch_id($term){
        return $this->builder->where('branch_id',$term);
    }
    public function department_id($term){
        return $this->builder->where('department_id',$term);
    }

    public function keyword($term)
    {
        return $this->builder->search($term);
    }

    public function courier($term)
    {
        return $this->builder->where('courier_id', $term);
    }
    public function operator($term)
    {
        return $this->builder->where('operator_id', $term);
    }
    
}
