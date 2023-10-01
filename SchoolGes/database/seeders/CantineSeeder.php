<?php

namespace Database\Seeders;

use App\Models\Cantine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CantineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Cantine::factory(10)->create();
    }
}
