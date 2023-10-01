<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
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
            "matiere_id" => 6,
            "classe_id" => 1,
            "salleclasse_id" => 1,
            "eleve_id" => 1,
            "trimestre_id" => 1,
            "sequence_id" => 2,
            "enseignant_id" => 1,
            "note" => 10,
        ];
    }
}
