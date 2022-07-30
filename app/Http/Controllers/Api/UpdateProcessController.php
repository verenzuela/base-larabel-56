<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Msg;
use App\WebSetting;

class UpdateProcessController extends BaseController
{
  public function versionStatus()
  {
    try {
      $webSetting =  WebSetting::find(1);

      if(!$webSetting){
        return response()->json(Msg::responseMsg( __('api.error.find.data'), false, 404), 404);
      }else{

        if($webSetting->count() === 0){
          return response()->json(Msg::responseMsg( __('api.no-data-found') , false, 404, $appConditions), 404);
        }else{
          $result = array( "store_base_code_status" => $webSetting->store_base_code_status );
          return response()->json(Msg::responseMsg( __('api.data-found') , true, 202, $result), 202);
        }                
      }
    } catch (Exception $e) {
      return response()->json(Msg::responseMsg($e, false, 500), 500);
    }
  }
}
