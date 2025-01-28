<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\DTO\RolePermission\RolePermissionDTO;

class RolePermissionService
{

    public function getRolePermissions(Role $role)
    {
        return [
            'role' => $role,
            'permissions' => Permission::all(),
        ];
    }

    public function updateRolePermissions(Role $role, RolePermissionDTO $dto): void
    {
        $permissions = Permission::whereIn('id', $dto->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);
    }
}
