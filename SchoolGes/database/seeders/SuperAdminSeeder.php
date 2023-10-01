<?php

namespace Database\Seeders;

use App\Models\Superadmin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Superadmin::create([
            'name' => 'douglas',
            'email' => 'douglas@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $superadmin_role = Role::firstOrCreate(['name' => 'superadmin','guard_name' => 'superadmin']);
        $superadmin->assignRole($superadmin_role);
    }
}
