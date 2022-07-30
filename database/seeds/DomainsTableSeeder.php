<?php

use Illuminate\Database\Seeder;
use App\Domain;
use App\WebSetting;
use App\WebLogo;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $domain = new Domain();
	    $domain->name = env('APP_DOMAIN');
	    $domain->description = 'principal domain';
        $domain->ssl = true;
	    $domain->save();

        $webSettings = new WebSetting();
        $webSettings->domain_id = $domain->id;
        $webSettings->adm_url = $domain->name.'/admin';
        $webSettings->web_url = $domain->name;
        $webSettings->api_url = $domain->name.'/api';
        $webSettings->save();

        

    }
}
