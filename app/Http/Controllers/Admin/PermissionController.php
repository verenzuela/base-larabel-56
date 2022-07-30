<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseAdminController as Controller;
use App\Permission;

class PermissionController extends Controller
{
  public function __construct(Permission $model){
      
    $config = [ 
        'title-msg' => 'Permission',
        'route'     => 'permissions', 
        'viewBase'  => 'admin.auth.permissions', 
        'model'     => $model,
        'permission'=> 'permission',
        'rows' => [
            ['name'=> 'name',  'type' => 'string' ],
            ['name' => 'display_name', 'type' => 'string' ],
            ['name' => 'description', 'type' => 'string' ],
        ],
        'hasFile' => false,
    ];

    $paramsToView['permission'] = $config['permission'];
    $paramsToView['route']      = $config['route'];
    $paramsToView['menuActive'] = 'tools_permissions'; #name on menu sidebar
    $paramsToView['h1Title']    = 'admin.permission.label'; #title on h1

    $paramsToView['seo'] = [   'locale'       => '',
                               'bodyCss'      => '',
                               'title'        => strtoupper(env('APP_NAME')).' | ',
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
    
}
