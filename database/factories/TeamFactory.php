<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
        ];
    }
}
