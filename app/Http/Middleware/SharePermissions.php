<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SharePermissions
{
    public function handle(Request $request, Closure $next): void
    {
        Inertia::share('permissions', function () use ($request) {
            return $request->user() ? $request->user()->getAllPermissions()->pluck('name') : [];
        });

    }
}
