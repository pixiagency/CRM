<?php

namespace App\DTO\Pipline;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class PiplineDTO extends BaseDTO
{

    /**
     * @param string $name
     * @param array $stages
     */
    public function __construct(
        public string $name,
        public array $stages,
    ) {}

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            stages: $request->stages,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            name: Arr::get($data, 'name'),
            stages: Arr::get($data, 'stages', []),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'stages' => $this->stages,
        ];
    }
}
