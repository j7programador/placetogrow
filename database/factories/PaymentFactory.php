<?php

namespace Database\Factories;

use App\Constants\CurrencyEnum;
use App\Constants\PaymentGateway;
use App\Constants\PaymentStatus;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(),
            'reference' => Str::random(),
            'amount' => 10000,
            'microsite_id' => Site::factory(),
            'currency' => CurrencyEnum::USD->name,
            'gateway' => PaymentGateway::PLACETOPAY->value,
            'status' => PaymentStatus::PENDING->value,
            'user_id' => User::factory(),
        ];
    }
}
