<?php

namespace App\Http\Requests\Users;

use App\DTO\User\UserDTO;
use App\Http\Requests\BaseRequest;

class UserStoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|numeric|unique:users,phone',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'status' => 'nullable|boolean',
            'type' => 'required|integer',
            'company_id' => 'nullable|integer|exists:companies,id',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'department_id' => 'nullable|integer|exists:departments,id',
            'notes' => 'nullable|string',
            'city_id' => 'required|integer|exists:locations,id',
            'area_id' => 'required|integer|exists:locations,id',
            'subarea_id' => 'nullable|integer|exists:locations,id',
            'address'=>'nullable|string',
            'permissions' => 'nullable|array|min:1',
            'permissions.*' => 'nullable|string|exists:permissions,name',
            // 'roles' => 'required|array|min:1',
            'role' => 'required|integer',
            'service_location_ids' => 'nullable|array',
            'head_offices_id' => 'nullable|exists:head_offices,id',
        ];
    }

    public function toUserDTO(): \App\DTO\BaseDTO
    {
        return UserDTO::fromRequest($this);
    }
}
