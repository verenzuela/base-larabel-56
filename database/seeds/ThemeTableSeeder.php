<?php

use Illuminate\Database\Seeder;
use App\Theme;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $theme = new Theme();
	    $theme->web_setting_id = 1;
        $theme->name = 'default';
        $theme->principal_color = '#ffffff';
	    $theme->status = 1;
	    $theme->save();

    }
}
