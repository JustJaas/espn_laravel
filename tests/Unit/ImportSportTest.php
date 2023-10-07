<?php

namespace Tests\Unit;

use App\Models\Sport;
use Tests\TestCase;

class ImportSportTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        Sport::factory()->create();

        $this->assertDatabaseHas('sports', [
            "id" => "123",
            "guid" => null,
            "uid" => "1234",
            "name" => "ejemplo",
            "slug" => "ejemplo",
            "logo" => "ejemplo.png",
        ]);
        $this->assertTrue(true);
    }
}
