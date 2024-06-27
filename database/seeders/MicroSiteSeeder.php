<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MicroSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MicroSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MicroSite::factory()->count(10)
            ->for(Category::factory()->create())->create();
    }
}
