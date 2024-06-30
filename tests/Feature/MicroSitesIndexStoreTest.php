<?php

namespace Tests\Feature;

use App\Constants\Permissions;
use App\Models\MicroSite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MicroSitesIndexStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testFormMicroSites(): void
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
        $response = $this->actingAs($user)
            ->get(route('microsites.create'));

        $response->assertOk();
    }

    public function testFailedFormMicrositesIndex(): void {
        $response = $this->get(route('microsites.create'));

        $response->assertRedirect(route('login'));
    }
}
