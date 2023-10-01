<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cantine;
use App\Models\Etablissement;
use App\Models\Infirmerie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Infirmerie::factory(10)->create();
        // Cantine::factory(10)->create();
        $this->call([
            // CantineSeeder::class,
            MaterieldidactiqueSeeder::class,
            FichesanteSeeder::class,
            EleveSeeder::class,
            ClasseSeeder::class,
            PosteSeeder::class,
            PosteEleveSeeder::class,
            ClasseSeeder::class,
            UserSeeder::class,
            AdmincirconscriptionSeeder::class,
        ]);
        // Etablissement::factory(10)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
