<?php

namespace Tests\Feature;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\MicroSite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MicroSitesIndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testListMicroSites(): void
    {
        $user = User::factory()->create();
        $baseRolesPersmission = [
            [
                'name' => 'Admin',
                'permissions' => [
                    Permissions::MICROSITE_VIEW,
                ],
            ],
        ];
        Permission::query()->create([
            'name' => Permissions::MICROSITE_VIEW,
        ]);

        foreach ($baseRolesPersmission as $role) {
            $rol = Role::query()->updateOrCreate(['name' => $role['name']]);

            $rol->syncPermissions($role['permissions']);
        }
        $user->assignRole('Admin');
        $response = $this->actingAs($user)
                        ->get(route('microsites.index'));

        $response->assertOk();
    }

    public function testAnUnauthenticatedUserCannotViewListSites(): void
    {
        $response = $this->get(route('microsites.index'));

        $response->assertStatus(403);
    }
}
