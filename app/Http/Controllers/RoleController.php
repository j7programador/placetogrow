<?php

namespace App\Http\Controllers;

use App\Constants\Permissions;
use App\Http\Requests\CreateRoleRequest;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Roles/Roles', [
            'roles' => Role::all(),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function edit(string $id): Response
    {
        $role = Role::findById($id);
        $role->load('permissions');

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'permissions' => Permission::all(),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function update(CreateRoleRequest $request, string $id)
    {
        $role = Role::findById($id);
        $role->update([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->input('permissions.*.name'));

        return back();
    }
}
