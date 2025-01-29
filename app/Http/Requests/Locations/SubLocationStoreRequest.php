<?php

namespace App\Http\Requests\Locations;

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
}
