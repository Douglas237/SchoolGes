<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Eleve>
 */
class EleveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nom' => $this->faker->firstName(),
            'prenom' => $this->faker->lastName(),
            'genre' => 'M',
            'photo' => 'string',
            'parent_id' => 1,
            'salleclasse_id' => 1,
            'classe_id' => 1,
            'region_origine' =>'required',
            'lieu_origine' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'date_naissance' => $this->faker->date('Y-m-d'),
            'lieu_naissance' => $this->faker->address,
        ];
    }
}
