<?php

namespace Database\Factories;

use App\Models\Infirmerie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fichesante>
 */
class FichesanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'etat' => fake()->sentence(),
            'description' => fake()->sentence(),
            'infirmerie_id' => Infirmerie::factory()->create()->id,
        ];
    }
}
