<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Domain;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role_root = Role::where('name', 'root')->first();
    	$role_admin  = Role::where('name', 'admin')->first();
    	$role_customer  = Role::where('name', 'customer')->first();

        $domain  = Domain::where('name', env('APP_DOMAIN'))->first();

    	$root = new User();
	    $root->name = 'Root User';
	    $root->email = env('USER_ROOT');
	    $root->password = bcrypt('<zaq12wsx');
        $root->is_domain_admin = true;
	    $root->save();
	    $root->roles()->attach($role_root);
        $root->domains()->attach($domain);    

	    $admin = new User();
	    $admin->name = 'Admin User';
	    $admin->email = env('USER_ADMIN');
	    $admin->password = bcrypt('<zaq12wsx');
        $admin->save();
	    $admin->roles()->attach($role_admin);
        $admin->domains()->attach($domain);

        $customer = new User();
        $customer->name = 'Jhon Doe';
        $customer->firstname = 'Jhon';
        $customer->lastname = 'Doe';
        $customer->email = 'jhond@'.env('APP_DOMAIN');
        $customer->type_user = 'frontend';
        $customer->password = bcrypt('<zaq12wsx');
        $customer->save();
        $customer->roles()->attach($role_customer);
        $customer->domains()->attach($domain);


        $customer = new User();
        $customer->name = 'Jane Doe';
        $customer->firstname = 'Jane';
        $customer->lastname = 'Doe';
        $customer->email = 'janed@'.env('APP_DOMAIN');
        $customer->type_user = 'frontend';
        $customer->password = bcrypt('<zaq12wsx');
        $customer->save();
        $customer->roles()->attach($role_customer);
        $customer->domains()->attach($domain);
    }
}
