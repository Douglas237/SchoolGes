<?php

namespace Database\Factories;

use App\Models\Etablissement;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cantine>
 */
class CantineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom" => fake()->name(),
            "stand" => fake()->sentence(),
            "etablissement_id" => Etablissement::factory()->create()->id,
        ];
    }
}
