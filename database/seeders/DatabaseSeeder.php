<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),

        ]);

        User::factory()->create([
            'name' => 'Client User',
            'email' => 'customer@example.com',
            'password' => bcrypt('12345678'),

        ]);

        $this->call(CategorySeeder::class);
        $this->call(MicroSiteSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(DefaultRolesAndPermissionsSeeder::class);

    }
}
