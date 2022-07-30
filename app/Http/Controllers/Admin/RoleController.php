<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseAdminController as Controller;
use App\Role;
use App\Permission;
use App\PermissionRole;
use DB;
use Auth;

class RoleController extends Controller
{
  public function __construct(Role $model){
      
    $config = [ 
      'title-msg' => 'Role',
      'route'     => 'roles', 
      'viewBase'  => 'admin.auth.roles', 
      'model'     => $model,
      'permission'=> 'role',
      'rows' => [
        ['name'=> 'name',  'type' => 'string' ],
        ['name' => 'display_name', 'type' => 'string' ],
        ['name' => 'description', 'type' => 'string' ],
      ],
      'hasFile' => false,
    ];

    $paramsToView['permission'] = $config['permission'];
    $paramsToView['route']      = $config['route'];
    $paramsToView['menuActive'] = 'tools_roles'; #name on menu sidebar
    $paramsToView['h1Title']    = 'admin.roles.label'; #title on h1

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

    $paramsToView['permissions'] = Permission::get();

    parent::__construct($config, $paramsToView);
  }
  

  public function edit($id, $paramsOnEdit=[]){
      $paramsOnEdit['rolePermissions'] = DB::table("permission_role")->where("permission_role.role_id",$id)->pluck('permission_role.permission_id','permission_role.permission_id')->all();
      return parent::edit($id, $paramsOnEdit);
  }

    
  public function addPermission($idRole, $idPermission)
  {
    try {
      if( Auth::user()->can('role-edit') ){

        $addPermissionRole = new PermissionRole();
        $addPermissionRole->role_id = $idRole;
        $addPermissionRole->permission_id = $idPermission;

        try{
          $addPermissionRole->save();
          echo "true";
        } catch (\Illuminate\Database\QueryException $e) {
          Handler::error(500, $e->getCode(), $e->getMessage());
        }
          
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }


  public function removePermission($idRole, $idPermission)
  {
    try {
      if( Auth::user()->can('role-edit') ){

        $removePermissionRole = PermissionRole::where("role_id",$idRole)->where("permission_id",$idPermission)->first();
        $permissionRole = PermissionRole::find($removePermissionRole->id);
        if($permissionRole){
          try{
            $permissionRole->delete();
            echo "true";
          } catch (\Illuminate\Database\QueryException $e) {
            Handler::error(500, $e->getCode(), $e->getMessage());
          };
        }else return redirect()->route('roles.index')->with('error','Permission for this rol not exist');
          
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }


}
