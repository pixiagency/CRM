<?php

namespace App\DTO\Location;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class LocationDTO extends BaseDTO
{
    /**
     * @param string $title',
     * @param ?int $parent_id',
     */
    public function __construct(
        protected string $title,
        protected ?int $parent_id,
    ) {}

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            title: $request->title,
            parent_id: $request->parent_id,
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
            parent_id: Arr::get($data, 'parent_id'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'parent_id' => $this->parent_id,
        ];
    }

    /**
     * Get the parent_id.
     *
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }
}
