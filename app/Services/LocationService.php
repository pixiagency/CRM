<?php

namespace App\Services;

use App\DTO\Location\LocationDTO;
use App\Models\Location;
use App\QueryFilters\LocationFilters;
use Illuminate\Database\Eloquent\Builder;


class LocationService extends BaseService
{
    public function __construct(
        public Location   $model,
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

    public function create()
    {
        $level = request()->segment(count(request()->segments()));
        $blade = match ($level) {
            'countries' => 'layouts.dashboard.location.country.create',
            'governorates' => 'layouts.dashboard.location.governorate.create',
            'cities' => 'layouts.dashboard.location.city.create',
            default => 'livewire.error404',
        };
        return $blade;
    }

    public function edit($id)
    {
        $level = request()->segment(3);
        $blade = match ($level) {
            'countries' => 'layouts.dashboard.location.country.edit',
            'governorates' => 'layouts.dashboard.location.governorate.edit',
            'cities' => 'layouts.dashboard.location.city.edit',
            default => 'livewire.error404',
        };
        return $blade;
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

    public function storeSubLocation(LocationDTO $locationDTO)
    {
        $location_data = $locationDTO->toArray();
        $location = $this->model->create($location_data);

        // #2 Using parent node
        $parent_id = $locationDTO->getParentId();
        $parent = $this->findById($parent_id);
        $parent->appendNode($location);

        return $location;
    }

    public function updateSubLocation(LocationDTO $locationDTO , $locationId)
    {
        // $location_data = $locationDTO->toArray();
        // $location = $this->model->create($location_data);

        // // #2 Using parent node
        // $parent_id = $locationDTO->getParentId();
        // $parent = $this->findById($parent_id);
        // $parent->appendNode($location);

        // return $location;

        // Fetch the existing location by ID
        $location = $this->findById($locationId);

        if (!$location) {
            throw new \Exception("Location not found.");
        }

        // Update location data
        $location_data = $locationDTO->toArray();
        $location->update($location_data);

        // Check if parent_id has changed
        $newParentId = $locationDTO->getParentId();
        if ($newParentId && $newParentId != $location->parent_id) {
            $newParent = $this->findById($newParentId);

            if (!$newParent) {
                throw new \Exception("Parent location not found.");
            }

            // Move the node to the new parent
            $newParent->appendNode($location);
        }

        return $location;
    }
}
