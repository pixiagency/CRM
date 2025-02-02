<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\RolePermissionService;
use App\DTO\RolePermission\RolePermissionDTO;
use App\Http\Requests\Roles\RoleStoreRequest;

class RolePermissionController extends Controller
{
    public function __construct(protected RolePermissionService $rolePermissionService) {
        $this->middleware('permission:view role-permissions', ['only' => ['index']]);
        $this->middleware('permission:edit role-permissions', ['only' => ['show','update']]);
        $this->middleware('permission:create role-permissions', ['only' => ['store','create']]);

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

    // Show role creation form
    public function create()
    {
        $permissions = $this->rolePermissionService->getAllPermissions();
        return view('layouts.dashboard.rolePermission.create', compact('permissions'));
    }

    // Store a new role and assign permissions
    public function store(RoleStoreRequest $request)
    {

        $this->rolePermissionService->createRoleWithPermissions($request->all());
        $toast = [
            'type' => 'success',
            'title' => 'success',
            'message' => trans('app.role_created_successfully')
        ];
        return to_route('role-permissions.index')->with('toast', $toast);
    }
}
