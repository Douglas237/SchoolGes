<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClasseSystem>
 */
class ClasseSystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "admincirconscription_id" => 1,
            "intituler_generale" => "6em",
            "code_classe_system" => "6em",
            "description" => "eleves de la 6em",
        ];
    }
}
