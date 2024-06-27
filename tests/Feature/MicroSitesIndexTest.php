<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\MicroSite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MicroSitesIndexTest extends TestCase
{

    public function testListMicroSites(): void
    {
        MicroSite::factory()
            ->for(Category::factory()->create())
            ->create([
                'name' => 'My Microsite'
            ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)
                        ->get(route('microsites.index'));

        $response->assertOk();
    }

    public function testAnUnauthenticatedUserCannotViewListSites(): void
    {
        $response = $this->get(route('microsites.index'));

        $response->assertRedirect(route('login'));
    }
}
