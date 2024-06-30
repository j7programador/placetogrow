<?php

namespace Database\Seeders;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseRolesPersmission = [
            [
                'name' => 'Admin',
                'permissions' => [
                    Permissions::MICROSITE_VIEW,
                    Permissions::MICROSITE_ANY,
                    Permissions::MICROSITE_EDIT,
                    Permissions::MICROSITE_DELETE,
                    Permissions::MICROSITE_CREATE,
                    Permissions::USER_CREATE,
                    Permissions::USER_EDIT,
                    Permissions::USER_DELETE,
                    Permissions::USER_VIEW,
                    Permissions::ROLE_EDIT,
                    Permissions::ROLE_VIEW,
                    Permissions::DASHBOARD_VIEW
                ],
            ],
            [
                'name' => 'Customer',
                'permissions' => [
                    Permissions::MICROSITE_VIEW,
                    Permissions::MICROSITE_ANY,
                ],
            ],
            [
                'name' => 'Guest',
                'permissions' => [
                    Permissions::MICROSITE_ANY,
                ],
            ],
        ];

        foreach ($baseRolesPersmission as $role) {
            $rol = Role::query()->updateOrCreate(['name' => $role['name']]);

            $rol->syncPermissions($role['permissions']);
        }

        User::query()->find(1)->assignRole('Admin');
        User::query()->find(2)->assignRole('Customer');
    }
}
