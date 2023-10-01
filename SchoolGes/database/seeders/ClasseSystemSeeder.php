<?php

namespace Database\Seeders;

use App\Models\ClasseSystem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClasseSystem::factory(1)->create();
    }
}
