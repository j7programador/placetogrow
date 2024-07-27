<?php

namespace Database\Seeders;

use App\Constants\Permissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Permissions::toArray() as $permission) {
            Permission::query()->create([
                'name' => $permission,
            ]);
        }
    }
}
