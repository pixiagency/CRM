<?php

namespace App\Http\Requests\Locations;

use App\DTO\Location\LocationDTO;
use App\Http\Requests\BaseRequest;

class SubLocationStoreRequest extends BaseRequest
{
    /**
     * Determine if the industry is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'parent_id' => 'required|integer|exists:locations,id',
        ];
    }

    public function toLocationDTO(): \App\DTO\BaseDTO
    {
        return LocationDTO::fromRequest($this);
    }
}
