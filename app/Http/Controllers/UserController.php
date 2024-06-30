<?php

namespace App\Http\Controllers;

use App\Actions\Users\DeleteAction;
use App\Constants\Permissions;
use App\Constants\Roles;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\MicroSite;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        return Inertia::render('Users', [
            'users' => User::all(),
            'currentUser' => $request->user(),
            'canEdit' => auth()->user()->can(Permissions::MICROSITE_EDIT),
            'canCreate' => auth()->user()->can(Permissions::MICROSITE_CREATE),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function edit(int $id): Response
    {

        return Inertia::render('User/Edit', [
            'user' => User::query()->where('id', $id)->find($id),
            'roles' => Roles::toArray(),
            'role' =>User::query()->where('id', $id)->find($id)->getRole($id),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }
    public function update(int $id, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user = User::query()->where('id', $id)->first();
        $user->save($request->all());
        $user->syncRoles([]);
        $user->assignRole($request->role);
        return to_route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(int $id, DeleteAction $deleteAction): \Illuminate\Http\RedirectResponse
    {
        $deleteAction->execute($id);
        return to_route('users.index')->with('success', 'Usuario eliminado con éxito');
    }
}
