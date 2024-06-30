<?php

namespace Tests\Feature;

use App\Constants\Permissions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionsTest extends TestCase
{
    public function test_constants_are_defined()
    {
        $this->assertTrue(defined(Permissions::class . '::MICROSITE_VIEW'));
        $this->assertTrue(defined(Permissions::class . '::MICROSITE_ANY'));
        $this->assertTrue(defined(Permissions::class . '::MICROSITE_EDIT'));
        $this->assertTrue(defined(Permissions::class . '::MICROSITE_DELETE'));
        $this->assertTrue(defined(Permissions::class . '::MICROSITE_CREATE'));
        $this->assertTrue(defined(Permissions::class . '::USER_CREATE'));
        $this->assertTrue(defined(Permissions::class . '::USER_EDIT'));
        $this->assertTrue(defined(Permissions::class . '::USER_DELETE'));
        $this->assertTrue(defined(Permissions::class . '::USER_VIEW'));
        $this->assertTrue(defined(Permissions::class . '::ROLE_VIEW'));
        $this->assertTrue(defined(Permissions::class . '::ROLE_EDIT'));
        $this->assertTrue(defined(Permissions::class . '::DASHBOARD_VIEW'));
    }

    public function test_toArray_method()
    {
        $constants = Permissions::toArray();

        $this->assertArrayHasKey('MICROSITE_VIEW', $constants);
        $this->assertArrayHasKey('MICROSITE_ANY', $constants);
        $this->assertArrayHasKey('MICROSITE_EDIT', $constants);
        $this->assertArrayHasKey('MICROSITE_DELETE', $constants);
        $this->assertArrayHasKey('MICROSITE_CREATE', $constants);
        $this->assertArrayHasKey('USER_CREATE', $constants);
        $this->assertArrayHasKey('USER_EDIT', $constants);
        $this->assertArrayHasKey('USER_DELETE', $constants);
        $this->assertArrayHasKey('USER_VIEW', $constants);
        $this->assertArrayHasKey('ROLE_VIEW', $constants);
        $this->assertArrayHasKey('ROLE_EDIT', $constants);
        $this->assertArrayHasKey('DASHBOARD_VIEW', $constants);

        $this->assertCount(12, $constants);
    }
}
