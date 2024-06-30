<?php

namespace Tests\Feature;

use App\Actions\Users\DeleteAction;
use App\Actions\Users\UpdateAction;
use App\Models\MicroSite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MicroSitesUsersTest extends TestCase
{
    public function testListUsers(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('users.index'));

        $response->assertOk();
    }

    public function testEditUsers(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('users.edit', $user->id));

        $response->assertOk();
    }

    public function testUpdateUsers(): void
    {
        $user = User::factory()->create();

        $updateActionMock = \Mockery::mock(UpdateAction::class);
        $this->app->instance(UpdateAction::class, $updateActionMock);

        $updateData = ['name' => 'Updated Name'];

        $updateActionMock->shouldReceive('execute')
            ->once()
            ->withArgs(function ($userArg, $requestArg) use ($user, $updateData) {
                return $userArg->id === $user->id && $requestArg->name === $updateData['name'];
            });
        $this->actingAs($user);
        $response = $this->put(route('users.update', $user->id), $updateData);

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'User updated successfully.');
    }

    public function testFailedUpdateUsers(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->from(route('users.edit', $user->id))
            ->put(route('users.update', $user->id), [
                'name' => ''
            ]);

        $response->assertRedirect(route('users.edit', $user->id));
        $response->assertSessionHasErrors(['name']);
    }

    public function testDestroyUsers(): void
    {
        $user = User::factory()->create();
        $deleteActionMock = \Mockery::mock(DeleteAction::class);
        $this->app->instance(DeleteAction::class, $deleteActionMock);

        $deleteActionMock->shouldReceive('execute')
            ->once()
            ->with($user->id);
        $this->actingAs($user);
        $response = $this->delete(route('users.delete', $user->id));
        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'User deleted');
    }
}
