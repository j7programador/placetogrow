<?php

namespace App\Http\Controllers;

use App\Actions\SubscriptionPlan\UpdateAction;
use App\Constants\BillingCycle;
use App\Constants\CurrencyEnum;
use App\Constants\Permissions;
use App\Constants\TypeSubscriptionEnum;
use App\Http\Requests\SubscriptionPlan\StoreRequest;
use App\Http\Requests\SubscriptionPlan\UpdateRequest;
use App\Models\Site;
use App\Models\SubscriptionPlan;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SubscriptionPlanController extends Controller
{
    public function index(): Response
    {

        $subscriptionPlans = SubscriptionPlan::with('site')->get();
        return Inertia::render('SubscriptionPlan/Index', [
            'subscriptionPlans' => $subscriptionPlans,
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
        $sites = Site::where('type_microsite', 'SUSCRIPTION')->get();

        $currencies = CurrencyEnum::toArray();
        $billingFrequencies = BillingCycle::toArray();
        $typesSubscription = TypeSubscriptionEnum::toArray();

        return Inertia::render('SubscriptionPlan/Create', [
            'sites' => $sites,
            'currencies' => $currencies,
            'types' => $typesSubscription,
            'billingFrequencies' => $billingFrequencies,
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        SubscriptionPlan::create($validated);

        return redirect()->route('subscriptionplan.index')->with('message', 'Subscription plan created successfully');
    }

    public function show(SubscriptionPlan $subscription): Response
    {
        $currencies = CurrencyEnum::toArray();
        $billingFrequencies = BillingCycle::toArray();

        return Inertia::render('SubscriptionPlan/Show', [
            'subscription' => $subscription,
            'currencies' => $currencies,
            'billingFrequencies' => $billingFrequencies,
        ]);
    }

    public function edit(int $id): Response
    {
        $sites = Site::where('type_microsite', 'SUSCRIPTION')->get();
        $currencies = CurrencyEnum::toArray();
        $billingFrequencies = BillingCycle::toArray();
        $typesSubscription = TypeSubscriptionEnum::toArray();

        return Inertia::render('SubscriptionPlan/Edit', [
            'sites' => $sites,
            'subscriptionPlan' => SubscriptionPlan::query()->where('id', $id)->find($id),
            'currencies' => $currencies,
            'billingFrequencies' => $billingFrequencies,
            'types' => $typesSubscription,
        ]);
    }

    public function update(UpdateAction $updateAction, UpdateRequest $request, int $id): RedirectResponse
    {
        $updateAction->execute($request, $id);

        return redirect()->route('subscriptionplan.index')->with('message', 'Subscription plan updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        SubscriptionPlan::destroy($id);

        return redirect()->route('subscriptionplan.index')->with('message', 'Subscription plan deleted successfully');
    }
}
