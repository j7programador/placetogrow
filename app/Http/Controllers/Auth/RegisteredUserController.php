<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Permissions;
use App\Constants\Roles;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register', [
            'canCreate' => auth()->user()->can(Permissions::MICROSITE_CREATE),
            'roles' => Roles::toArray(),
            'name' => trans('auth.register.name'),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]
        );
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect(route('users.index', absolute: false));
    }
}
