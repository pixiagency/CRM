<?php

namespace App\Services;

use App\DTO\Location\LocationDTO;
use App\Models\Location;
use App\QueryFilters\LocationFilters;
use Illuminate\Database\Eloquent\Builder;


class LocationService extends BaseService
{
    public function __construct(
        public Location               $model,
    ) {}

    public function getModel(): Location
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
        $locations = $this->model->with($withRelations)->orderBy('id', 'desc');
        return $locations->filter(new LocationFilters($filters));
    }

    public function datatable(array $filters = [], array $withRelations = [])
    {

        $locations = $this->getQuery()->with($withRelations);
        return $locations->filter(new LocationFilters($filters));
    }

    public function store(LocationDTO $locationDTO)
    {
        $location_data = $locationDTO->toArray();
        $location = $this->model->create($location_data);
        return $location;
    }

    public function update(LocationDTO $locationDTO, $id)
    {
        $location = $this->findById($id);
        $location->update($locationDTO->toArray());
        return true;
    }

    public function deleteMultiple(array $ids)
    {
        return $this->getQuery()->whereIn('id', $ids)->delete();
    }

    public function delete(int $id)
    {
        return $this->getQuery()->where('id', $id)->delete();
    }
}
