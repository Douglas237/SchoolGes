<?php

namespace Database\Seeders;

use App\Models\Fichesante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FichesanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Fichesante::factory(10)->create();
    }
}
