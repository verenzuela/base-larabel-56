<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseAdminController as Controller;
use App\Theme as Model;

class ThemeController extends Controller
{

	public function __construct(Model $model){
        
    $config = [ 
      'title-msg' => __('admin.label.themes'),#Title used for notifications on error or success
      'route'     => 'themes',#name of route tipy resource 
      'viewBase'  => 'admin.settings.theme',#path base view laravel 
      'model'     => $model,
      'permission'=> 'theme',#pre name assigned on permission
      #field of table types permited: string | numeric | boolean | file
      'rows' => [
				['name'=> 'name',                     'type' => 'string' ],
				['name'=> 'principal_color',          'type' => 'string' ],
        ['name'=> 'custom_principal_color',   'type' => 'boolean' ],
        ['name'=> 'pagination',               'type' => 'numeric' ],
        ['name'=> 'custom_pagination',        'type' => 'boolean' ],
        ['name'=> 'enable_shopping_cart',     'type' => 'boolean' ],
        ['name'=> 'enable_questions_produtcs',  'type' => 'boolean' ],
        ['name'=> 'status',                   'type' => 'boolean' ],
      ],
      'hasFile' => false, #indicate if request content a file input
    ];

    $paramsToView['permission'] = $config['permission'];
    $paramsToView['route']      = $config['route'];
    $paramsToView['menuActive'] = 'settings_theme'; #name on menu sidebar
    $paramsToView['h1Title']    = 'admin.theme.label'; #title on h1

    $paramsToView['seo'] = ['locale'       => '',
														'bodyCss'      => '',
														'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.label.themes'),
														'ogTitle'      => '',
														'ogLocale'     => '',
														'ogDescription'=> '',
														'ogUrl'        => '',
														'ogSiteName'   => '',
														'autor'        => '',
														'description'  => '',
														'canonicalUrl' => '',
                          ];

    #use paramsToView to send information to views: edit or create, the variable is a single asociate array. ej. $paramsToView[key]=value;
    parent::__construct($config, $paramsToView);
  }


}