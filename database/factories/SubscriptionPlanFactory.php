<?php

namespace Database\Factories;

use App\Constants\BillingCycle;
use App\Constants\CurrencyEnum;
use App\Constants\PaymentGateway;
use App\Constants\PaymentStatus;
use App\Constants\TypeSubscriptionEnum;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriptionPlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(200),
            'amount' => $this->faker->numberBetween(1000, 100000),
            'currency' => CurrencyEnum::USD->name,
            'subscription_expiration' => $this->faker->optional()->numberBetween(1, 365),
            'billing_cycle' => BillingCycle::MONTHLY->name,
            'type' => TypeSubscriptionEnum::BASIC->name,
            'process_identifier' => $this->faker->optional()->numberBetween(1000, 9999),
            'site_id' => Site::factory(),
        ];
    }
}

