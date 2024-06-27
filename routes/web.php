<?php

use App\Constants\Permissions;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'canCreate' => auth()->user()->can(Permissions::MICROSITE_CREATE)
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/microsites', [\App\Http\Controllers\MicroSiteController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('microsites.index');

Route::get('/microsites/create', [\App\Http\Controllers\MicroSiteController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('microsites.create');

Route::post('/microsites/create', [\App\Http\Controllers\MicrositeController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('microsites.store');

Route::get('/microsites/{id}/edit', [\App\Http\Controllers\MicrositeController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('microsites.edit');

Route::put('/microsites/update/{id}', [\App\Http\Controllers\MicroSiteController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('microsites.update');

Route::delete('/microsites/{id}', [\App\Http\Controllers\MicroSiteController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('microsites.delete');

Route::get('/microsites/{id}', [\App\Http\Controllers\MicroSiteController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('microsites.delete');

Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('users.index');

Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('users.delete');


require __DIR__.'/auth.php';
