<?php

namespace App\Http\Requests\Locations;

use App\DTO\Location\LocationDTO;
use App\Http\Requests\BaseRequest;


class LocationUpdateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
        ];
    }

    public function toLocationDTO(): \App\DTO\BaseDTO
    {
        return LocationDTO::fromRequest($this);
    }
}
