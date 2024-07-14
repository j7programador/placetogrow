<?php

namespace Tests\Feature;

use App\Constants\DocumentTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentTypeEnumTest extends TestCase
{
    public function test_enum_values_are_defined()
    {
        $this->assertTrue(defined(DocumentTypeEnum::class . '::CC'));
        $this->assertTrue(defined(DocumentTypeEnum::class . '::NIT'));
        $this->assertTrue(defined(DocumentTypeEnum::class . '::RUT'));
        $this->assertTrue(defined(DocumentTypeEnum::class . '::PPT'));
        $this->assertTrue(defined(DocumentTypeEnum::class . '::CE'));
    }

}
