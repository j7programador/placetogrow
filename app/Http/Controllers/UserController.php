<?php

namespace App\Http\Controllers;

use App\Actions\Users\DeleteAction;
use App\Actions\Users\UpdateAction;
use App\Constants\Permissions;
use App\Constants\Roles;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request): Response
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
            'role' => User::query()->where('id', $id)->find($id)->getRole($id),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function update(int $id, UpdateAction $updateAction, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user = User::query()->where('id', $id)->first();
        $updateAction->execute($user, $request);

        return to_route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(int $id, DeleteAction $deleteAction): RedirectResponse
    {
        $deleteAction->execute($id);

        return to_route('users.index')->with('success', 'User deleted');
    }
}
