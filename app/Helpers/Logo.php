<?php

namespace App\Helpers;
use App\WebLogo;
use App\WebSetting;
use App\Domain;

class Logo
{	
	public function __construct(){
    
	}

	public static function header($tag_header='header_logo', $domain='')
	{
		$domain = ($domain != '') ? $domain : env('APP_DOMAIN');
		$domain = Domain::where('name', $domain)->firstOrFail();

		if($domain->websettings){
			$logo = $domain->websettings->webLogo->where('name', '=', $tag_header)->first();
			
			if( $logo ){
				if($logo->img_url != ''){

					if($logo->img_url == "images/blank.png") return $logo->img_url;

					return $image = 'storage/'.$logo->img_url;
				}
			}
		}
		return 'images/blank.png';	
	}

	public static function footer($tag_header='footer_logo', $domain='')
	{
		$domain = ($domain != '') ? $domain : env('APP_DOMAIN');
		$domain = Domain::where('name', $domain)->firstOrFail();

		if($domain->websettings){
			$logo = $domain->websettings->webLogo->where('name', '=', $tag_header)->first();

			if( $logo ){
				if($logo->img_url != ''){

					if($logo->img_url == "images/blank.png") return $logo->img_url;

					return $image = 'storage/'.$logo->img_url;
				}
			}
		}
		return 'images/blank.png';	
	}

}