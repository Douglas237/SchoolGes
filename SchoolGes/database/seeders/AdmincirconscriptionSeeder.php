<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admincirconscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdmincirconscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        $admin = Admincirconscription::create([
            'name' => 'douglas',
            'email' => 'douglas@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $admin_role = Role::firstOrCreate(['name' => 'admins_circonscription','guard_name' => 'admins_circonscription']);
        $admin->assignRole($admin_role);
    }
}
