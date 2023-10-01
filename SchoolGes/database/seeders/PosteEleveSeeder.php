<?php

namespace Database\Seeders;

use App\Models\PosteEleve;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosteEleveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PosteEleve::factory(10)->create();
    }
}
