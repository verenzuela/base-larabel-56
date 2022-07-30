<?php

use Illuminate\Database\Seeder;
use App\PermissionRole;
use App\Permission;
use App\Role;

class PermissionRoleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {   
    $rootId = Role::where('name', 'root')->value('id');
    $adminId = Role::where('name', 'admin')->value('id');
    $customerId = Role::where('name', 'customer')->value('id');
    
    
    $permissions = Permission::get();
    foreach($permissions as $permission){
      PermissionRole::create(['permission_id' => $permission->id, 'role_id' => $rootId]); 
    }
    
    PermissionRole::create(['permission_id' => Permission::where('name', 'user-settings')->value('id'), 'role_id' => $adminId]);
    PermissionRole::create(['permission_id' => Permission::where('name', 'user-settings')->value('id'), 'role_id' => $customerId]);
    
  }
}
