<?php

namespace App\Helpers;
use App\WebSetting;
use App\Domain;
use Session;

class Info
{	
	public function __construct(){
    
	}

	public static function contactPhone()
	{	
		return 'no-phone-number';
	}

	public static function infoEmail()
	{	
		$webSetting = WebSetting::find(1);
		return ( $webSetting->adm_email ) ? $webSetting->adm_email : "no-email@address.com";
	}

	public static function senderEmail()
	{
		return env('MAIL_FROM_ADDRESS');
	}
	
	public static function teamName()
	{
		return 'The '.__('APP_NAME').' Team';
	}

}