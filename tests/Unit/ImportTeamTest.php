<?php

namespace Tests\Unit;

use App\Models\Team;
use Tests\TestCase;

class ImportTeamTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        Team::factory()->create();

        $this->assertDatabaseHas('teams', [
            "id" => "123",
            "guid" => "1234",
            "uid" => "12345",
            "slug" => "equipo",
            "location" => "ubicacion",
            "name" => "Equipo",
            "nickname" => null,
            "abbreviation" => null,
            "displayName" => "equipo",
            "shortDisplayName" => "equi",
            "isActive" => "0",
            "isAllStar" => "0",
        ]);
        $this->assertTrue(true);
    }
}
