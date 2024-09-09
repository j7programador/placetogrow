<?php

namespace Tests\Feature\Subscription;

use App\Constants\StatusEnum;
use App\Constants\TypeMicrositeEnum;
use App\Constants\TypeSubscriptionEnum;
use App\Models\Category;
use App\Models\Site;
use Database\Factories\SiteFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BaseSubscription extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        Http::fake(['https://checkout-co.placetopay.dev/api/session' => Http::response(
            [
                "status" => [
                    "status" => "OK",
                    "reason" => "PC",
                    "message" => "La petición se ha procesado correctamente",
                    "date" => "2021-11-30T15:08:27-05:00",
                ],
                "requestId" => 1,
                "processUrl" =>
                    "https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a",
            ]
        )]);

        Category::factory()->create();
        $site = Site::factory()->create(['type_microsite' => TypeMicrositeEnum::SUSCRIPTION->name]);
        $this->postJson(route('subscription.store'), [
                'reference'=> 'test',
                'email'=> 'jor@gmail.com',
                'microsite_id' => $site->id,
                'plan'=> [
                    'type' => 'basic',
                    'price' => '20.000',
                    'months' => 12,
                ]
        ])->assertRedirect("https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a");

        $this->assertDatabaseHas('users', ['email' => 'jor@gmail.com']);
        $this->assertDatabaseHas('subscriptions', ['type' => TypeSubscriptionEnum::BASIC->name,
            'status' => StatusEnum::PENDING->name,
            'site_id' => $site->id,
        ]);
    }
}
