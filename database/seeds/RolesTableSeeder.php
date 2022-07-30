<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'root', 'display_name' => 'Root', 'description' => 'Super use role']);
        Role::create(['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Admin role']);
        Role::create(['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer Role']);

        
    }
}   