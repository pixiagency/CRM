<?php

namespace App\Services;

use App\Models\Service;
use App\QueryFilters\ServiceFilters;
use Illuminate\Database\Eloquent\Builder;
class ServiceService extends BaseService{
    public $user;

    public function __construct(
        public Service               $model,
    ) {}

    public function getModel(): Service
    {
        return $this->model;
    }

    public function getAll(array $filters = [])
    {
        return $this->queryGet($filters)->get();
    }

    public function getTableName(): String
    {
        return $this->getModel()->getTable();
    }

    public function listing(array $filters = [], array $withRelations = [], $perPage = 5): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function queryGet(array $filters = [], array $withRelations = []): Builder
    {
        $services = $this->model->with($withRelations)->orderBy('id', 'desc');
        return $services->filter(new ServiceFilters($filters));
    }

    public function getQuery(): Builder
    {
        return $this->model->newQuery();
    }
    public function datatable(array $filters = [], array $withRelations = [])
    {
        $services = $this->getQuery()->with($withRelations);
        return $services->filter(new ServiceFilters($filters));
    }
    

}
