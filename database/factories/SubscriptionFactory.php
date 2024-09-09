<?php

namespace Database\Factories;

use App\Constants\StatusEnum;
use App\Constants\TypeSubscriptionEnum;
use App\Models\Site;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'reference' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(StatusEnum::toArray()),
            'status_message' => $this->faker->sentence,
            'request_id' => $this->faker->uuid,
            'type' => $this->faker->randomElement(TypeSubscriptionEnum::toArray()),
            'token' => Str::random(40),
            'sub_token' => Str::random(40),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'additional_data' => json_encode([
                'extra' => $this->faker->words(3, true)
            ]),
            'site_id' => Site::factory(),
            'customer_id' => User::factory(),
        ];
    }
}
