<?php

use App\Constants\Permissions;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FieldsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Models\Payment;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'microsites' => Site::all(),
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
        'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
        'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        'microsites' => Site::count(),
        'users' => User::count(),
        'micrositesBasic' => Site::query()->where('type_microsite', 'BASIC')->count(),
        'micrositesBill' => Site::query()->where('type_microsite', 'BILL')->count(),
        'micrositesSuscription' => Site::query()->where('type_microsite', 'SUSCRIPTION')->count(),
        'payments' => Payment::count(),
    ]);
})->middleware(['auth', 'verified', 'can:dashboard-view'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/microsites', [\App\Http\Controllers\MicroSiteController::class, 'index'])
    ->middleware(['can:microsite_view'])->name('microsites.index');

Route::get('/microsites/create', [\App\Http\Controllers\MicroSiteController::class, 'create'])
    ->middleware(['auth', 'verified', 'can:microsite_create'])->name('microsites.create');

Route::post('/microsites/create', [\App\Http\Controllers\MicrositeController::class, 'store'])
    ->middleware(['auth', 'verified', 'can:microsite_create'])->name('microsites.store');

Route::get('/microsites/{id}/edit', [\App\Http\Controllers\MicrositeController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('microsites.edit');

Route::put('/microsites/update/{id}', [\App\Http\Controllers\MicroSiteController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('microsites.update');

Route::delete('/microsites/{id}', [\App\Http\Controllers\MicroSiteController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('microsites.delete');

Route::get('/microsites/{id}', [\App\Http\Controllers\MicroSiteController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('microsites.view');

Route::get('/microsite/{slug}', [\App\Http\Controllers\MicroSiteController::class, 'viewMicrosite'])
    ->name('microsites.viewMicroSite');

Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('users.index');

Route::get('/users/{id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('users.edit');

Route::put('/users/update/{id}', [\App\Http\Controllers\UserController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('users.update');

Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('users.delete');

Route::middleware(['can:microsite_create'])->group(function () {
    Route::resource('/roles', RoleController::class);
});

Route::resource('categories', CategoryController::class)
    ->middleware(['auth', 'verified', 'can:microsite_create'])->names('categories');

Route::post('payments', [PaymentController::class, 'store'])
    ->name('payments.store');

Route::get('payments/{payment}', [PaymentController::class, 'show'])
    ->name('payments.show');

Route::middleware(['can:microsite_create'])->group(function () {
    Route::resource('/fields', FieldsController::class);
});

require __DIR__.'/auth.php';
