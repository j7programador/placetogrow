<?php

namespace App\Actions\SubscriptionPlan;

use App\Http\Requests\SubscriptionPlan\UpdateRequest;
use App\Models\SubscriptionPlan;

class UpdateAction
{
    public function execute(UpdateRequest $request, int $id): void
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $subscriptionPlan = SubscriptionPlan::query()->where('id', $id)->first();
        $subscriptionPlan->update($request->all());

    }
}
