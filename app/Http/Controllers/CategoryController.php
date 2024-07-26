<?php

namespace App\Http\Controllers;

use App\Actions\Categories\StoreAction;
use App\Actions\Categories\UpdateAction;
use App\Constants\DocumentTypeEnum;
use App\Constants\Permissions;
use App\Constants\TypeMicrositeEnum;
use App\Http\Requests\UpdateMicroSiteRequest;
use App\Models\Category;
use App\Models\MicroSite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {

        return Inertia::render('Categories/Categories', [
            'categories' => Category::all(),
            'canEdit' => auth()->user()->can(Permissions::MICROSITE_EDIT),
            'canCreate' => auth()->user()->can(Permissions::MICROSITE_CREATE),
            'canDelete' => auth()->user()->can(Permissions::MICROSITE_DELETE),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function create() : Response
    {
        return Inertia::render('Categories/Create', [
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function store(StoreAction $storeAction, Request $request): RedirectResponse
    {
        $storeAction -> execute($request);
        return to_route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(int $id): Response
    {
        return Inertia::render('Categories/Edit', [
            'category' => Category::query()->where('id', $id)->find($id),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);

    }

    public function update(UpdateAction $updateAction, UpdateMicroSiteRequest $request, int $id): RedirectResponse
    {
        $updateAction ->execute($request, $id);
        return to_route('categories.index')->with('success', 'Category updated successfully.');

    }

    public function destroy(int $id): RedirectResponse
    {

        $microsite = MicroSite::query()->where('category_id', $id)->first($id);

        if($microsite != null) {
            return to_route('categories.index')->with('danger', 'There are microsites created with this category');
        }
        Category::destroy($id);
        return to_route('categories.index')->with('danger', 'Category deleted successfully');
    }

}
