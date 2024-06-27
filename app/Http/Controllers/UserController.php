<?php

namespace App\Http\Controllers;

use App\Actions\Users\DeleteAction;
use App\Constants\Permissions;
use App\Constants\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        return Inertia::render('Users', [
            'users' => User::all(),
            'currentUser' => $request->user(),
            'canEdit' => auth()->user()->can(Permissions::MICROSITE_EDIT),
            'canCreate' => auth()->user()->can(Permissions::MICROSITE_CREATE),
        ]);
    }

    public function destroy(int $id, DeleteAction $deleteAction): \Illuminate\Http\RedirectResponse
    {
        $deleteAction->execute($id);
        return to_route('users.index')->with('success', 'Usuario eliminado con éxito');
    }
}
