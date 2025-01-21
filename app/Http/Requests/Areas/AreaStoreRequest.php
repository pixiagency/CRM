<?php

namespace App\Http\Requests\Areas;

use App\Http\Requests\BaseRequest;

class AreaStoreRequest extends BaseRequest
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
            'parent_id' => 'nullable|integer|exists:locations,id',
        ];
    }
}
