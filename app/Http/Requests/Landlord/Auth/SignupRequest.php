<?php

namespace App\Http\Requests\Landlord\Auth;

use App\Http\Requests\BaseRequest;

class SignupRequest extends BaseRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email'   => 'required|email|unique:users',
            'password'   => 'required|min:6',
            'organization' => 'required|string|max:10',
        ];
    }
}
