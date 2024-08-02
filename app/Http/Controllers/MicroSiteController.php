<?php

namespace App\Http\Controllers;

use App\Actions\MicroSites\DeleteAction;
use App\Actions\MicroSites\StoreAction;
use App\Actions\MicroSites\UpdateAction;
use App\Constants\CurrencyEnum;
use App\Constants\DocumentTypeEnum;
use App\Constants\PaymentGateway;
use App\Constants\Permissions;
use App\Constants\TypeMicrositeEnum;
use App\Http\Requests\UpdateMicroSiteRequest;
use App\Models\Category;
use App\Models\MicroSite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MicroSiteController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MicroSites', [
            'microsites' => MicroSite::all(),
            'canEdit' => auth()->user()->can(Permissions::MICROSITE_EDIT),
            'canCreate' => auth()->user()->can(Permissions::MICROSITE_CREATE),
            'canDelete' => auth()->user()->can(Permissions::MICROSITE_DELETE),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Microsite/Create', [
            'documentTypes' => array_column(DocumentTypeEnum::cases(), 'name'),
            'categories' => Category::query()->select(['id', 'name'])->get(),
            'micrositeTypes' => array_column(TypeMicrositeEnum::cases(), 'name'),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function store(StoreAction $storeAction, Request $request): RedirectResponse
    {
        $storeAction->execute($storeAction, $request);

        return to_route('microsites.index')->with('success', 'Microsite created successfully.');
    }

    public function show(int $id): Response
    {
        $microsite = MicroSite::query()->where('id', $id)->find($id);

        return Inertia::render('Microsite/View', [
            'microSite' => $microsite,
            'category' => Category::query()->where('id', $microsite->category_id)->find($microsite->category_id),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function edit(int $id): Response
    {
        return Inertia::render('Microsite/Edit', [
            'microSite' => MicroSite::query()->where('id', $id)->find($id),
            'documentTypes' => array_column(DocumentTypeEnum::cases(), 'name'),
            'categories' => Category::query()->select(['id', 'name'])->get(),
            'micrositeTypes' => array_column(TypeMicrositeEnum::cases(), 'name'),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);

    }

    public function update(UpdateAction $updateAction, UpdateMicroSiteRequest $request, int $id): RedirectResponse
    {
        $updateAction->execute($request, $id);

        return to_route('microsites.index')->with('success', 'Micro Site updated successfully.');

    }

    public function destroy(int $id, DeleteAction $deleteAction): RedirectResponse
    {
        $deleteAction->execute($id);

        return to_route('microsites.index')->with('danger', 'Microsite deleted successfully');
    }

    public function viewMicrosite(string $slug): Response
    {
        $microsite = MicroSite::query()->where('slug', $slug)->first();
        $micrositeType = $microsite->type_microsite;
        $currencies = array_column(CurrencyEnum::cases(), 'name');
        $documentTypes = array_column(DocumentTypeEnum::cases(), 'name');
        $gateways = array_column(PaymentGateway::cases(), 'value');

        if ($micrositeType == 'BASIC') {
            return Inertia::render('Microsite/Basic', [
                'microSite' => $microsite,
                'currencies' => $currencies,
                'documentTypes' => $documentTypes,
                'gateways' => $gateways,
            ]);
        } elseif ($micrositeType == 'BILL') {
            return Inertia::render('Microsite/Basic', [
                'microSite' => $microsite,
                'currencies' => $currencies,
                'documentTypes' => $documentTypes,
                'gateways' => $gateways,
            ]);
        }

        return Inertia::render('Microsite/Suscription', [
            'microSite' => $microsite,
            'currencies' => $currencies,
            'documentTypes' => $documentTypes,
            'gateways' => $gateways,
        ]);
    }
}
