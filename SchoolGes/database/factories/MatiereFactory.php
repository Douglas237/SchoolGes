<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matiere>
 */
class MatiereFactory extends Factory
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
            "classe_id" => 1,
            "etablissement_id" => 1,
            "code_matiere" => 124,
            "intituler_etablissement" => "mathematique",
            "volumehoraire_etablissement" => 4,
            "coefficient_etablissement" => 4,
            "matieresyst_id" => 1,
        ];
    }
}
