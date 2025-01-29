<?php

namespace App\Services;

use App\Models\Client;
use App\QueryFilters\ClientFilters;
use Illuminate\Database\Eloquent\Builder;
use App\DTO\Client\ClientDTO;

class ClientService extends BaseService
{
    public function __construct(
        public Client $model,
    ) {}

    public function getModel(): Client
    {
        return $this->model;
    }

    public function getAll(array $filters = [])
    {
        return $this->queryGet($filters)->get();
    }

    public function getTableName(): string
    {
        return $this->getModel()->getTable();
    }

    public function listing(array $filters = [], array $withRelations = [], $perPage = 5): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function queryGet(array $filters = [], array $withRelations = []): Builder
    {
        $clients = $this->model->with($withRelations)->orderBy('id', 'desc');
        return $clients->filter(new ClientFilters($filters));
    }

    public function datatable(array $filters = [], array $withRelations = [])
    {
        $clients = $this->getQuery()->with($withRelations);
        return $clients->filter(new ClientFilters($filters));
    }

    public function store(ClientDTO $clientDTO)
    {
        $clientData = $clientDTO->toArray();

        // Create the client in the clients table
        $client = $this->model->create($clientData);

        // Handle industries relationship
        if ($clientDTO->industries) {
            $client->industries()->sync($clientDTO->industries);
        }

        // Handle services relationship
        if ($clientDTO->services) {
            $client->services()->sync($clientDTO->services);
        }

        // Handle custom fields relationship
        if ($clientDTO->customFields) {
            $customFieldsData = [];
            foreach ($clientDTO->customFields as $fieldId => $value) {
                $customFieldsData[$fieldId] = ['value' => $value];
            }
            $client->customFields()->sync($customFieldsData);
        }

        return $client;
    }

    public function update(int $id, ClientDTO $clientDTO)
    {
        // Find the client by ID or fail if not found
        $client = $this->model->findOrFail($id);

        // Update client fields
        $clientData = $clientDTO->toArray();
        $client->update($clientData);

        // Handle industries relationship
        if ($clientDTO->industries) {
            $client->industries()->sync($clientDTO->industries);
        } else {
            $client->industries()->detach();
        }

        // Handle services relationship
        if ($clientDTO->services) {
            $client->services()->sync($clientDTO->services);
        } else {
            $client->services()->detach();
        }

        // Handle custom fields relationship
        if ($clientDTO->customFields) {
            $customFieldsData = [];
            foreach ($clientDTO->customFields as $fieldId => $value) {
                $customFieldsData[$fieldId] = ['value' => $value];
            }
            $client->customFields()->sync($customFieldsData);
        } else {
            $client->customFields()->detach();
        }

        return $client;
    }

}
