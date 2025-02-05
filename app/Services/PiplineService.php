<?php

namespace App\Services;

use App\DTO\Pipline\PiplineDTO;
use App\Models\Pipline;
use App\QueryFilters\PiplineFilters;
use Illuminate\Database\Eloquent\Builder;


class PiplineService extends BaseService
{
    public function __construct(
        public Pipline               $model,
    ) {}

    public function getModel(): Pipline
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
        $industries = $this->model->with($withRelations)->orderBy('id', 'desc');
        return $industries->filter(new PiplineFilters($filters));
    }

    public function datatable(array $filters = [], array $withRelations = [])
    {

        $industries = $this->getQuery()->with($withRelations);
        return $industries->filter(new PiplineFilters($filters));
    }

    public function store(PiplineDTO $piplineDTO): Pipline
    {
        dd($piplineDTO);
        $pipline = $this->model->create([
            'name' => $piplineDTO->name,
        ]);

        foreach ($piplineDTO->stages as $stageData) {
            $pipline->stages()->create([
                'name' => $stageData['name'],
                'seq_number' => $stageData['seq_number'],
            ]);
        }

        return $pipline;
    }

}
