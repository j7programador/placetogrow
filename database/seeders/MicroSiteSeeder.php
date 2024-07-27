<?php

namespace Database\Seeders;

use App\Models\MicroSite;
use Illuminate\Database\Seeder;

class MicroSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MicroSite::factory()->count(10)->create();
    }
}
