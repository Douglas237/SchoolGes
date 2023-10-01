<?php

namespace Database\Seeders;

use App\Models\Materieldidactique;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterieldidactiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materieldidactique::factory(10)->create();
    }
}
