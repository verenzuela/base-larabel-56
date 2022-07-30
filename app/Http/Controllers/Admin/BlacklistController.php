<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseAdminController as Controller;
use App\BlackListEmail;
use App\WhiteListEmail;

class BlacklistController extends Controller
{
  public function __construct(BlackListEmail $model){
      
    $config = [ 
        'title-msg' => __('admin.blacklist.label'),
        'route'     => 'blacklist', 
        'viewBase'  => 'admin.blacklist', 
        'model'     => $model,
        'permission'=> 'blacklist',
        'rows' => [
            ['name'=> 'firstname', 'type' => 'string' ],
            ['name'=> 'lastname', 'type' => 'string' ],
            ['name'=> 'phone', 'type' => 'string' ],
            ['name' => 'email', 'type' => 'string' ],
        ],
        'hasFile' => false,
    ];

    $paramsToView['permission'] = $config['permission'];
    $paramsToView['route']      = $config['route'];
    $paramsToView['menuActive'] = 'users_blacklist'; #name on menu sidebar
    $paramsToView['h1Title']    = 'admin.blacklist.label'; #title on h1

    $paramsToView['seo'] = [  'locale'       => '',
                              'bodyCss'      => '',
                              'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.blacklist.label'),
                              'ogTitle'      => '',
                              'ogLocale'     => '',
                              'ogDescription'=> '',
                              'ogUrl'        => '',
                              'ogSiteName'   => '',
                              'autor'        => '',
                              'description'  => '',
                              'canonicalUrl' => '',
                            ];

    parent::__construct($config, $paramsToView);
  }

  public function store(Request $request, $returnToEdit=false){

      $whiteListEmail = WhiteListEmail::where('email', '=', $request->input('email'))->get();
      if( $whiteListEmail->count() > 0 )
        return redirect()->route('blacklist.index')->with('error', 'Email is in Whitelist, please remove before...');
      return parent::store($request);
  }

}
