<?php

namespace Database\Seeders;

use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{

    public function run(): void
    {
        foreach (Roles::toArray() as $role) {
            Role::query()->create(
                [
                    'name' => $role,
                ]
            );
        }
    }
}
