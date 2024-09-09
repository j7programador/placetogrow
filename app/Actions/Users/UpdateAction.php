<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Http\Request;

class UpdateAction
{
    public function execute(User $user, Request $request): void
    {
        $user->name = $request->get('name');
        $user->save();
        $user->syncRoles([]);
        $user->assignRole($request->role);
    }
}
