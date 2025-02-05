<?php

namespace App\Http\Requests\Pipline;

use App\DTO\Pipline\PiplineDTO;
use Illuminate\Foundation\Http\FormRequest;

class PiplineStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'stages' => 'required|array',
            'stages.*.name' => 'required|string',
            'stages.*.seq_number' => 'required|integer',
        ];
    }
    public function toPiplineDTO(): \App\DTO\BaseDTO
    {
        return PiplineDTO::fromRequest($this);
    }
}
