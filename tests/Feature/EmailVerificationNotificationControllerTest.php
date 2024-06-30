<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class EmailVerificationNotificationControllerTest extends TestCase
{
    public function testEmailVerificationNotificationCanBeRequested()
    {
        Notification::fake();
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $this->actingAs($user);

        $response = $this->post(route('verification.send'));

        $response->assertSessionHas('status', 'verification-link-sent');

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_email_verification_notification_is_not_sent_if_already_verified()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        $response = $this->post(route('verification.send'));

        $response->assertRedirect(route('dashboard'));

        $response->assertSessionMissing('status');

        Notification::assertNothingSent();
    }

    public function testEmailVerificationNotificationRequiresAuthentication()
    {
        $response = $this->post(route('verification.send'));

        $response->assertRedirect(route('login'));
    }
}
