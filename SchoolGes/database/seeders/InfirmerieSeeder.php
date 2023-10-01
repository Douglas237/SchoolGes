<?php

namespace Database\Seeders;

use App\Models\Infirmerie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InfirmerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Infirmerie::factory(10)->create();
    }
}
