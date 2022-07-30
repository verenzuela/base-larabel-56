<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {   
    $this->call(RolesTableSeeder::class);
    $this->call(DomainsTableSeeder::class);
    $this->call(PermissionsTableSeeder::class);
    $this->call(PermissionRoleTableSeeder::class);
    $this->call(UserTableSeeder::class);
    $this->call(ThemeTableSeeder::class);
        
  }
}
