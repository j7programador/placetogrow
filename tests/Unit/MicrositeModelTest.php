<?php

namespace Tests\Unit;

use App\Models\MicroSite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MicrositeModelTest extends TestCase
{

    use RefreshDatabase;

    public function testCanCreateUser()
    {
        $microsite = MicroSite::factory()->count(1)->create();

        $this->assertDatabaseCount('micro_sites', 1);
    }
}
