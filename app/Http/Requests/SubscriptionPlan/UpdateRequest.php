<?php

namespace App\Http\Requests\SubscriptionPlan;

use App\Constants\BillingCycle;
use App\Constants\TypeSubscriptionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|max:100',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required',
            'description' => 'nullable|string',
            'subscription_expiration' => 'required|integer|min:1|max:1440',
            'site_id' => 'required|exists:sites,id',
            'process_identifier' => 'required|numeric|min:0',
            'type' => 'required|in:'.implode(',', TypeSubscriptionEnum::toArray()),
            'billing_cycle' => 'required|in:'.implode(',', BillingCycle::toArray()),
        ];
    }
}
