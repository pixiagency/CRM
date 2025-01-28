<?php

namespace App\Http\Controllers\Web;

use App\DTO\RolePermission\RolePermissionDTO;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\RolePermissionService;

class RolePermissionController extends Controller
{
    public function __construct(protected RolePermissionService $rolePermissionService) {
        $this->middleware('permission:view role-permissions', ['only' => ['index']]);
        $this->middleware('permission:update role-permissions', ['only' => ['show','update']]);

    }

    // Show the role selection page
    public function index()
    {
        $roles = Role::where('name', '!=', 'super admin')->get();
        return view('layouts.dashboard.rolePermission.index', compact('roles'));
    }

    // Show the permissions for the selected role
    public function show(Role $role)
    {
        $data = $this->rolePermissionService->getRolePermissions($role);
        return view('layouts.dashboard.rolePermission.show', $data);
    }

    // Update the role's permissions
    public function update(Request $request, Role $role)
    {
        $dto = RolePermissionDTO::fromRequest($request);
        $this->rolePermissionService->updateRolePermissions($role, $dto);

        return redirect()->route('role-permissions.index', $role->id)
            ->with('toast', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Role permissions updated successfully.',
            ]);
    }
}
