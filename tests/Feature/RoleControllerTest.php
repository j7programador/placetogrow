<?php

namespace Tests\Feature;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        $user = User::factory()->create();
        $baseRolesPersmission = [
            [
                'name' => 'Admin',
                'permissions' => [
                    Permissions::MICROSITE_CREATE,
                ],
            ],
        ];
        Permission::query()->create([
            'name' => Permissions::MICROSITE_CREATE,
        ]);

        foreach ($baseRolesPersmission as $role) {
            $rol = Role::query()->updateOrCreate(['name' => $role['name']]);

            $rol->syncPermissions($role['permissions']);
        }
        $user->assignRole('Admin');
        $user = User::factory()->create();

        $this->actingAs($user);

        $roles = Role::query()->create(
            ['name' => 'admin']
        );

        $response = $this->get('/roles');

        $response->assertStatus(200);
    }
}
