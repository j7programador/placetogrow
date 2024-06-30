<?php

namespace Tests\Feature;

use App\Actions\Users\DeleteAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteActionUser extends TestCase
{
    use RefreshDatabase;

    public function test_execute_deletes_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $action = new DeleteAction();
        $action->execute($user->id);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
