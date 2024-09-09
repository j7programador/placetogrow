<?php

namespace App\Actions\Subscription\StoreAction;

use App\Constants\StatusEnum;
use App\Constants\TypeSubscriptionEnum;
use App\Models\Site;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Inertia\Inertia;

class StoreAction
{
    public function execute(Request $request)
    {
        $plan = request() ->get('plan');
        $reference = request()->get('reference'). '_' . Str::random(4);
        $description = 'Plan ' . $plan['type'].' COP $'.$plan['amount'];
        $customer = User::query()->where('email', request() ->get('email'))->first();
        if(!$customer?->exists()) {
            $customer = User::factory()->create(['email' => request() ->get('email')]);
        }
        $site = Site::query()->where('id', request()->get('microsite_id'))->first();

        $subscription = Subscription::factory()->create(
            [
                'reference' => $reference,
                'description' => $description,
                'status' => StatusEnum::PENDING->name,
                'type' => TypeSubscriptionEnum::BASIC->name,
                'price' => $plan['amount'],
                'expiration_date' => now()->addMonth(1)->toDate(),
                'site_id' => (int) $site->id,
                'customer_id' => $customer->id,
            ]
        );

        $data = [
            'auth' => $this->generateAuthData(),
            'buyer' => [
                'email' => $customer->email,
            ],
            'reference' => $reference,
            'description' => $description,
            'expiration' => now()->addMinutes(30)->toIso8601String(),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->userAgent(),
            'returnUrl' => route('subscription.return', [
                'microsite' => $site->slug,
                'reference' => $reference,
                'subscription' => $subscription->id,
            ]),
            'subscription' => [
                'reference' => $subscription->reference,
                'description' => $subscription->description,
            ]
        ];

        return [
            'data' => $data,
            'subscription' => $subscription,
        ];
    }

    private function generateAuthData() : array
    {
        $login = config('subscription.placetopay')['login'];
        $secretKey = config('subscription.placetopay')['secret_key'];
        $seed = now()->toIso8601String();
        $rawNonce = Str::random();
        $tranKey = base64_encode(hash('sha256', $rawNonce.$seed.$secretKey, true));
        $nonce = base64_encode($rawNonce);

        return [
            'login' => $login,
            'tranKey' => $tranKey,
            'seed' => $seed,
            'nonce' => $nonce
        ];

    }

}
