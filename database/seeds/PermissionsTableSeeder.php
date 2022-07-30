<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {

  	$permission = [
              
      #roles
      ['name' => 'role-list','display_name' => 'Role - Listing Display','description' => 'See only Listing Of Role'],
      ['name' => 'role-create','display_name' => 'Role - Create','description' => 'Create New Role'],
      ['name' => 'role-edit','display_name' => 'Role - Edit','description' => 'Edit Role'],
      ['name' => 'role-delete','display_name' => 'Role - Delete','description' => 'Delete Role'],

      #user
      ['name' => 'user-list','display_name' => 'User - Listing Display','description' => 'See only Listing Of Users'],
      ['name' => 'user-create','display_name' => 'User - Create','description' => 'Create New User'],
      ['name' => 'user-edit','display_name' => 'User - Edit','description' => 'Edit User'],
      ['name' => 'user-delete','display_name' => 'User - Delete','description' => 'Delete User'],
      ['name' => 'user-settings','display_name' => 'User - Settings','description' => 'Allows access to user settings'],

      #permission
      ['name' => 'permission-list','display_name' => 'Permission - Listing Display','description' => 'Permission listing display option'],
      ['name' => 'permission-create','display_name' => 'Permission - Create','description' => 'Permission create role'],
      ['name' => 'permission-edit','display_name' => 'Permission - Edit','description' => 'Edit permission'],
      ['name' => 'permission-delete','display_name' => 'Permission - Delete','description' => 'Permission delete option'],

      #audit
      ['name' => 'audit-list','display_name' => 'Audit - Listing Display','description' => 'Audit listing display option'],

      #email-list
      ['name' => 'email-list','display_name' => 'Email - Listing Display','description' => 'Email listing display option'],

      #menu
      ['name' => 'menu-dashboard','display_name' => 'Menu - dashboard','description' => 'Show menu dasboard'],
      ['name' => 'menu-user','display_name' => 'Menu - user','description' => 'Show menu user'],
      ['name' => 'menu-auth','display_name' => 'Menu - auth','description' => 'Show menu auth'],
      ['name' => 'menu-audit','display_name' => 'Menu - audit','description' => 'Show menu audit'],
      ['name' => 'menu-email-log','display_name' => 'Menu - email log','description' => 'Show menu email log'],
      ['name' => 'menu-contracts','display_name' => 'Menu - Contracts','description' => 'Show menu contracts'],

      #contracts
      ['name' => 'contract-list','display_name' => 'Contracts - Listing Display','description' => 'See only Listing Of Contracts'],
      ['name' => 'contract-create','display_name' => 'Contracts - Create','description' => 'Create New Contracts'],
      ['name' => 'contract-edit','display_name' => 'Contracts - Edit','description' => 'Edit Contracts'],
      ['name' => 'contract-delete','display_name' => 'Contracts - Delete','description' => 'Delete Contracts'],

    ];

    foreach ($permission as $key => $value) {
      Permission::create($value);
    }
    
  }
}
