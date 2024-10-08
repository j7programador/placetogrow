<?php

namespace Tests\Feature\Payments;

use App\Constants\CurrencyEnum;
use App\Constants\DocumentTypeEnum;
use App\Constants\PaymentGateway;
use App\Constants\PaymentStatus;
use App\Models\Category;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class StorePaymentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itStoresPaymentSuccessfully(): void
    {
        $this->withoutExceptionHandling();

        $responseData = [
            'status' => [
                'status' => 'OK',
                'reason' => 'PC',
                'message' => 'Respuesta falsa',
                'date' => '2021-11-30T15:08:27-05:00',
            ],
            'requestId' => 1,
            'processUrl' => 'https://checkout-co.placetopay.dev/session/1/cc9b8690b1f7228c78b759ce27d7e80a',
        ];

        Http::fake(fn (Request $request) => Http::response($responseData, 200));

        Category::factory()->create();
        $microsite = Site::factory()->create();
        $user = User::factory()->create();
        $data = [
            'reference' => '1341234',
            'description' => fake()->sentence(),
            'amount' => 10000,
            'site_id' => $microsite->id,
            'currency' => CurrencyEnum::USD->name,
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => fake()->freeEmail,
            'document_number' => 12123123123,
            'document_type' => DocumentTypeEnum::CC->name,
            'gateway' => PaymentGateway::PLACETOPAY->value,
        ];


        $this->post(route('payments.store'), $data);

        $this->assertDatabaseHas('payments', [
            'user_id' => $user->id,
            'site_id' => $microsite->id,
            'description' => $data['description'],
            'amount' => 10000,
            'gateway' => PaymentGateway::PLACETOPAY->value,
            'status' => PaymentStatus::PENDING->value,
            'process_identifier' => $responseData['requestId'],
        ]);
    }
}
