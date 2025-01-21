<?php

namespace App\Services;
use App\Models\Resource;
use App\DTO\Resource\ResourceDTO;
use App\QueryFilters\ResourceFilters;
use Illuminate\Database\Eloquent\Builder;

class ResourceService extends BaseService
{
    public function __construct(
        public Resource               $model,
    ) {}

    public function getModel(): Resource
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
        $resources = $this->model->with($withRelations)->orderBy('id', 'desc');
        return $resources->filter(new ResourceFilters($filters));
    }

    public function datatable(array $filters = [], array $withRelations = [])
    {
        $resources = $this->getQuery()->with($withRelations);
        return $resources->filter(new ResourceFilters($filters));
    }

    public function store(ResourceDTO $resourceDTO){
        $resource_data=$resourceDTO->toArray();
        $reaon=$this->model->create($resource_data);
        return $reaon;
    }

    public function update(ResourceDTO $resourceDTO,$id){
        $resource=$this->findById($id);
        $resource->update($resourceDTO->toArray());
        return true;
    }

    public function delete(int $id)
    {
        return $this->getQuery()->where('id', $id)->delete();
    }
}
