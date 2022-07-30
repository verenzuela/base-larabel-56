<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseAdminController as Controller;
use App\[model_name_here] as Model;

class [name_controller_here]Controller extends Controller
{
    public function __construct(Model $model){
        
        $config = [ 
            'title-msg' => '',#Title used for notifications on error or success
            'route'     => '',#name of route tipy resource 
            'viewBase'  => '',#path base view laravel 
            'model'     => $model,
            'permission'=> '',#pre name assigned on permission
            #field of table types permited: string | numeric | boolean | file
            'rows' => [
                ['name'=> '',  'type' => '' ],
                [   
                /*Field to storage file, support multiples files only when type storage is complex*/
                'name' => '', 'type' => 'file', 
                    /*SUPPORT in content filename or file extension only to storage this information os file or parent_id and file url if filestorage is complex content permited: parent_id | file_url | file_name | file_extension */
                    'fileFieldsInfo' => [ 
                        ['name' => '', 'type' => '', 'content' => '' ],
                    ],
                ],
            ],
            'hasFile' => false, #indicate if request content a file input
            'fileStoragePath' => '[storage_name_here]', #use to indicate folder storage name
            /*SUPPORT [single]:when image info storage in same table | [complex]: when image info storage in childtable */
            'typeStorage' => '',
            'storageModel'=> [storage_model_var_here], #use to indicate a name of model to storage file information, the model need passed on construct
        ];

        $paramsToView['permission'] = $config['permission'];
        $paramsToView['route']      = $config['route'];
        $paramsToView['menuActive'] = ''; #name on menu sidebar
        $paramsToView['h1Title']    = ''; #title on h1

        $paramsToView['seo'] = [   'locale'       => '',
                                   'bodyCss'      => '',
                                   'title'        => '',
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

    public function store(Request $request){

        #insert validation here
        $this->validate($request, [

        ]);

        return parent::store($request);
    }

    public function update(Request $request, $id){

        #insert validation here
        $this->validate($request, [

        ]);

        return parent::update($request, $id);
    } 

}
