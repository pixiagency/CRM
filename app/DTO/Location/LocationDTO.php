<?php

namespace App\DTO\Location;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class LocationDTO extends BaseDTO
{
    /**
     * @param string $title',
     * @param ?int $city_id',
     */
    public function __construct(
        protected string $title,
        protected ?int $city_id,
    ) {}

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            title: $request->title,
            city_id: $request->city_id,
        );
    }

    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            title: Arr::get($data, 'title'),
            city_id: Arr::get($data, 'city_id'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'city_id' => $this->city_id,
        ];
    }

    /**
     * Get the city_id.
     *
     * @return int
     */
    public function getCityId(): int
    {
        return $this->city_id;
    }
}
