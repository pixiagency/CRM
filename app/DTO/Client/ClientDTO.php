<?php

namespace App\DTO\Client;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class ClientDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $email,
        public string $address,
        public ?int $city_id = null,
        public int $resource_id,
        public ?array $industries = null,
        public ?array $services = null,
        public ?array $serviceCategories = null,
        public ?array $customFields = null,
    ) {}

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->input('name'),
            phone: $request->input('phone'),
            email: $request->input('email'),
            address: $request->input('address'),
            city_id: $request->input('city_id'),
            resource_id: $request->input('resource_id'),
            industries: $request->input('industry'),
            services: $request->input('services'),
            serviceCategories: $request->input('serviceCategories', []),
            customFields: $request->input('custom_fields'),

        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'city_id' => $this->city_id,
            'resource_id' => $this->resource_id,
            'industries' => $this->industries,
            'services' => $this->services,
            'serviceCategories'=> $this->services,
            'customFields' => $this->customFields,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: Arr::get($data, 'name'),
            phone: Arr::get($data, 'phone'),
            email: Arr::get($data, 'email'),
            address: Arr::get($data, 'address'),
            resource_id: Arr::get($data, 'resource_id'),
            industries: Arr::get($data, 'industries'),
            services: Arr::get($data, 'services'),
            customFields: Arr::get($data, 'customFields'),
        );
    }
}
