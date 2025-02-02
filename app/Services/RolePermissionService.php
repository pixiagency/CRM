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

    // Retrieve all permissions
    public function getAllPermissions()
    {
        return Permission::all();
    }
    // Create a new role and assign permissions
    public function createRoleWithPermissions(array $data)
    {
        // Create role
        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);
        // Assign permissions
        if (!empty($data['permissions'])) {
            $permissions = Permission::whereIn('id', $data['permissions'])->get();
            $role->syncPermissions($permissions);
        }
        return $role;
    }
}
