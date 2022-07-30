<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseAdminController as Controller;
use App\WebLogo as Model;
use File;
use Storage;

class WebLogoController extends Controller
{
  public function __construct(Model $model){
      
    $config = [ 
      'title-msg' => __('admin.web-logos.label'),#Title used for notifications on error or success
      'route'     => 'web-logos',#name of route tipy resource 
      'viewBase'  => 'admin.settings.web-logo',#path base view laravel 
      'model'     => $model,
      'permission'=> 'web-logo',#pre name assigned on permission
      #field of table types permited: string | numeric | boolean | file
      'rows' => [
        ['name'=> 'name',  'type' => 'string' ],
        ['name' => 'web_setting_id', 'type' => 'numeric' ],
        ['name'=> 'name', 'type' => 'string' ],
        ['name'=> 'display_name', 'type' => 'string' ],
        ['name' => 'status', 'type' => 'boolean' ],
        ['name' => 'custom', 'type' => 'boolean' ],
        ['name' => 'width', 'type' => 'numeric' ],
        ['name' => 'height', 'type' => 'numeric' ],
        [   
        /*Field to storage file, support multiples files only when type storage is complex*/
        'name' => 'img_url', 'type' => 'file', 
          /*SUPPORT in content filename or file extension only to storage this information os file or parent_id and file url if filestorage is complex content permited: parent_id | file_url | file_name | file_extension */
          'fileFieldsInfo' => [ 
            ['name' => 'img_name', 'type' => 'string', 'content' => 'file_name' ],
            ['name' => 'img_type', 'type' => 'string', 'content' => 'file_extension' ],
          ],
        ],
      ],
      'hasFile' => true, #indicate if request content a file input
      'fileStoragePath' => 'web-logo_images', 
      'typeStorage' => 'single',
    ];

    $paramsToView['permission'] = $config['permission'];
    $paramsToView['route']      = $config['route'];
    $paramsToView['menuActive'] = 'settings_web-logos'; #name on menu sidebar
    $paramsToView['h1Title']    = 'admin.web-logos.label'; #title on h1

    $paramsToView['seo'] = [  'locale'       => '',
                              'bodyCss'      => '',
                              'title'        => strtoupper(env('APP_NAME')).' | '.__('admin.web-logos.label'),
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


  public function store(Request $request, $returnToEdit=false){
    $request['custom'] = true;

    return parent::store($request, $returnToEdit);
  }


  public function update(Request $request, $id){
    $row =  $this->config["model"]::find($id);
    $request['custom'] = $row->custom;

    return parent::update($request, $id);
  }


  public function destroy($id, $file=''){

    $model = Model::find($id);
    $file = $model->img_url;
    $exist =  Model::where('img_url', $file)->get();
    if(count($exist) == 0){
        $file='';
    }

    return parent::destroy($id, $file);
  }

}
