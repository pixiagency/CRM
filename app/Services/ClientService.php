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
        // dd( $clientData);
        // Create the client
        $client = $this->model->create($clientData);
        // Sync industries
        if ($clientDTO->industries) {
            $client->industries()->sync($clientDTO->industries);
        }
        // Sync services correctly
        if ($clientDTO->services) {
            $servicesData = [];
            foreach ($clientDTO->services as $serviceId) {
                if (is_numeric($serviceId) && $serviceId > 0) {
                    $categoryId = $clientDTO->serviceCategories[$serviceId] ?? null;
                    $servicesData[$serviceId] = ['category_id' => $categoryId];
                }
            }
            $client->services()->sync($servicesData);
        }
        // Sync custom fields
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
        if (!empty($clientDTO->industries)) {
            $client->industries()->sync($clientDTO->industries);
        } else {
            $client->industries()->detach(); // Remove all industries if empty
        }
        // Handle services and categories
        $servicesData = [];
        if (!empty($clientDTO->services)) {
            foreach ($clientDTO->services as $serviceId) {
                if (is_numeric($serviceId) && $serviceId > 0) {
                    $categoryId = $clientDTO->serviceCategories[$serviceId] ?? null;
                    $servicesData[$serviceId] = ['category_id' => $categoryId];
                }
            }
            $client->services()->sync($servicesData);
        } else {
            $client->services()->detach();
        }
        // Handle custom fields relationship
        $customFieldsData = [];
        if (!empty($clientDTO->customFields)) {
            foreach ($clientDTO->customFields as $fieldId => $value) {
                $customFieldsData[$fieldId] = ['value' => $value];
            }
            $client->customFields()->sync($customFieldsData);
        } else {
            $client->customFields()->detach();
        }
        return $client;
    }


    public function delete(int $id)
    {
        return $this->getQuery()->where('id', $id)->delete();
    }

}
