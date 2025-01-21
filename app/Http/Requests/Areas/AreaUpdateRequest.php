<?php

namespace App\Http\Requests\Areas;

use App\Http\Requests\BaseRequest;

class AreaUpdateRequest extends BaseRequest
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
            'parent_id' => 'nullable|integer|exists:locations,id',
        ];
    }
}
