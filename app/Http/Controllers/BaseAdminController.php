<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\HtmlElement;
use App\Exceptions\Handler;
use App\Helpers\Constants;
use App\Helpers\Format;
use App\Helpers\Image;
use Session;
use Storage;
use Auth;
use File;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseAdminController extends Controller
{
  
  /**
  *
  *
  *
  */
  public function __construct($config, $paramsToView)
  {
    $this->middleware(['auth', 'BlackList']);
    $this->config = $config;
    $this->image = new Image();
    $this->constants = new Constants();

    $this->paramsToView = $paramsToView;
    $this->paramsToView['render'] = new HtmlElement();
    $this->paramsToView['Format'] = new Format();
    $this->paramsToView['Constants'] = $this->constants;

    if( !isset($this->config['returnJson']) ) $this->config['returnJson'] = false;

    $this->json = $this->config['returnJson'];
  }
  
  
  /**
  *
  *
  *
  */
  public function getRandomToken($length, $seed){    
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "0123456789";

    mt_srand($seed);

    for($i=0;$i<$length;$i++){
      $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
    }
    return $token;
  }
  
  
  /**
  *
  *
  *
  */
  public function index(){
    try {
      if( Auth::user()->can($this->config["permission"].'-list') ){
        $rows =  $this->config["model"]::orderBy('id', 'desc')->paginate(10);

        $this->json = ( $this->config['returnJson'] ) ? $this->config['returnJson'] : false;
        $params = $this->paramsToView;
        $params['rows'] = $rows;

        //start return response
        $data=$this->data('index', $params, true, 200);
        $redirect = view($this->config["viewBase"].'.index', $params );
        return $this->return($redirect, $data, $this->json);
        //end return response

      }else{
        //-----------------------
        $redirect = Handler::error( 403, 401, '', $this->json );
        $data=$this->data('index', $redirect, false, 500);
        return $this->return($redirect, $data, $this->json);
        //-----------------------
      }
    } catch (Exception $e) {
      //-----------------------
      $redirect = Handler::error( 500, $e->getCode(), $e->getMessage(), $this->json );
      $data=$this->data('index', $redirect, false, 500);
      return $this->return($redirect, $data, $this->json);
      //-----------------------
    }
  }
  
  
  /**
  * Show
  *
  *
  */
  public function show($id) {
    return redirect()->route($this->config["route"].'.edit', ['id' => $id]);
  }


  public function create(){
    try {
      if( Auth::user()->can($this->config["permission"].'-create') ){
        
        $redirect = view($this->config["viewBase"].'.create', $this->paramsToView );
        $data=$this->data('create', $redirect, true, 200);
        return $this->return($redirect, $data, $this->json);

      }else{
        $redirect = Handler::error(403, 401, '', $this->json );
        $data=$this->data('create', $redirect, false, 403);
        return $this->return($redirect, $data, $this->json);
      }
        
    } catch (Exception $e) {
      //-----------------------
      $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
      $data=$this->data('create', $redirect, false, 500);
      return $this->return($redirect, $data, $this->json);
      //-----------------------
    }
  }
  
  
  /**
  * Store
  *
  *
  */
  public function store(Request $request, $returnToEdit=false){
    try {
      if( Auth::user()->can($this->config["permission"].'-create') ){
        $fields = $this->populateFields($request, 'store');
        try{
          $model = $this->config["model"]::create($fields);
          
          if (!$model->exists) {
            //start return response
            $data=$this->data('store', $model->errors, false, 500);
            $redirect = back()->withInput($request->input())->withErrors($model->errors);
            return $this->return($redirect, $data, $this->json);
            //end return response
          }

          if($this->config["hasFile"]){
            if($this->config["typeStorage"]=='complex'){
              $this->saveMultiFile($model->id, $request);
            }
          }

          if($returnToEdit){
            $redirect = redirect()->route($this->config["route"].'.edit', ['id' => $model->id ])->with('status', __('admin.data_add_success', ['object' => $this->config["title-msg"] ]) );

            //start return response
            $row = ['id' => $model->id ];
            $data = $this->data('store', $row, true, 200);
            return $this->return($redirect, $data, $this->json);
            //end return response

          }else{
            //-----------------------
            $row = ['id' => $model->id ];
            $redirect = redirect()->route($this->config["route"].'.index')->with('status', __('admin.data_add_success', ['object' => $this->config["title-msg"] ]) );
            $data=$this->data('store', $row, true, 200);
            return $this->return($redirect, $data, $this->json);
            //-----------------------
          }
            
        } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          if($errorCode == 1062){
            //-----------------------
            $redirect = back()->withInput($request->input())->withErrors([$e->getCode() => __('admin.duplicate_info') ]);
            $data=$this->data('store', $redirect, false, 500);
            return $this->return($redirect, $data, $this->json);
            //-----------------------
          }

          //Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
          //-----------------------
          $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
          $data=$this->data('store', $redirect, false, 500);
          return $this->return($redirect, $data, $this->json);
          //-----------------------
        };

      }else{
        //-----------------------
        $redirect = Handler::error(403, 401, '', $this->json );
        $data=$this->data('store', $redirect, false, 403);
        return $this->return($redirect, $data, $this->json);
        //-----------------------
      }  
    } catch (Exception $e) {
      //-----------------------
      $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
      $data=$this->data('store', $redirect, false, 500);
      return $this->return($redirect, $data, $this->json);
      //-----------------------
    }
  }
  
  
  /**
  * Edit
  *
  *
  */
  public function edit($id, $paramsOnEdit=[]){
    try {
      if( Auth::user()->can($this->config["permission"].'-edit') ){
        $row =  $this->config["model"]::find($id);

        if($row===null){
          //-----------------------
          $redirect = \Redirect::back()->withErrors([ __('admin.data_no_exist', ['object' => $this->config["title-msg"] ]) ]);
          $data=$this->data('edit', $redirect, false, 403);
          return $this->return($redirect, $data, $this->json);
          //-----------------------
        }

        $params = $this->paramsToView;
        $params['row'] = $row;

        $params = array_merge($params, $paramsOnEdit);

        //start return response
        $data=$this->data('edit', $params, true, 200);
        $redirect = view($this->config["viewBase"].'.edit', $params );
        return $this->return($redirect, $data, $this->json);
        //end return response

      }else{
        //-----------------------
        $redirect = Handler::error(403, 401, '', $this->json );
        $data=$this->data('edit', $redirect, false, 403);
        return $this->return($redirect, $data, $this->json);
        //-----------------------
      }

    } catch (Exception $e) {
      //-----------------------
      $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
      $data=$this->data('edit', $redirect, false, 500);
      return $this->return($redirect, $data, $this->json);
      //-----------------------
    }
  }
  
  
  /**
  * Update
  *
  *
  */
  public function update(Request $request, $id){
    try {
      if( Auth::user()->can($this->config["permission"].'-edit') ){

        $row =  $this->config["model"]::find($id);
        if($row){
            
          $fields = $this->populateFields($request, 'update');
          $row->fill($fields);

          try{
            if(!$row->save()){
              //start return response
              $data=$this->data('update', $row->errors, true, 200);
              $redirect = back()->withInput($request->input())->withErrors($row->errors);
              return $this->return($redirect, $data, $this->json);
              //end return response
            }

            if($this->config["hasFile"]){
              if($this->config["typeStorage"]=='complex'){
                $this->saveMultiFile($row->id, $request);
              }
            }

            //start return response
            $redirect = redirect()->route($this->config["route"].'.index')->with('status', __('admin.data_updated_success', ['object' => $this->config["title-msg"] ]) );
            $row->fresh();
            $data=$this->data('update', $row, true, 200);
            return $this->return($redirect, $data, $this->json);
            //end return response

          } catch (\Illuminate\Database\QueryException $e) {
            //-----------------------
            $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
            $data=$this->data('update', $redirect, false, 500);
            return $this->return($redirect, $data, $this->json);
            //-----------------------
          };
        }else{
          $redirect = redirect()->route($this->config["route"].'.index')
                        ->with('error', __('admin.data_no_exist', ['object' => $this->config["title-msg"] ]) );
          $data=$this->data('update', $redirect, false, 403);
          return $this->return($redirect, $data, $this->json);
        }

      }else{
        //-----------------------
        $redirect = Handler::error(403, 401, '', $this->json );
        $data=$this->data('update', $redirect, false, 403);
        return $this->return($redirect, $data, $this->json);
        //-----------------------
      }

    } catch (Exception $e) {
      //-----------------------
      $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
      $data=$this->data('update', $redirect, false, 500);
      return $this->return($redirect, $data, $this->json);
      //-----------------------
    }    
  }
  
  
  /**
  * Destroy
  *
  *
  */
  public function destroy($id, $file=''){
    try {
      if( Auth::user()->can($this->config["permission"].'-delete') ){
        $row =  $this->config["model"]::find($id);
        if($row){
          try{
            if($this->config["hasFile"]){
              if($this->config["typeStorage"]=='single'){
                $row->delete();
                Storage::delete($file);
              }elseif($this->config["typeStorage"]=='complex'){

                foreach($file as $fileDetail){
                  Storage::delete($fileDetail["file_path"]);
                  $this->config["storageModel"]::find($fileDetail["id"])->delete();
                }

                $row->delete();
                  
              }else{
                //start return response
                $data=$this->data('destroy', $this->config["title-msg"].' invalid typeStorage D001', true, 200);
                $redirect = redirect()->route($this->config["route"].'.index')->with('error', $this->config["title-msg"].' invalid typeStorage D001');
                return $this->return($redirect, $data, $this->json);
                //end return response
              }
            }else{
              $row->delete();
            }
            
            //start return response
            $data=$this->data('destroy', $this->config["title-msg"], true, 200);
            $redirect = redirect()->route($this->config["route"].'.index')->with('status', __('admin.data_delete_success', ['object' => $this->config["title-msg"] ]) );
            return $this->return($redirect, $data, $this->json);
            //end return response


          } catch (\Illuminate\Database\QueryException $e) {
            //-----------------------
            $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
            $data=$this->data('destroy', $redirect, false, 500);
            return $this->return($redirect, $data, $this->json);
            //-----------------------
          }
        }else{
          //-----------------------
          $redirect = redirect()->route($this->config["route"].'.index')->with('error', $this->config["title-msg"].' not exist');
          $data=$this->data('destroy', $redirect, false, 403);
          return $this->return($redirect, $data, $this->json);
          //-----------------------
        }

      }else {
        //-----------------------
        $redirect = Handler::error(403, 401, '', $this->json );
        $data=$this->data('destroy', $redirect, false, 403);
        return $this->return($redirect, $data, $this->json);
        //-----------------------
      }
    } catch (Exception $e) {
      //-----------------------
      $redirect = Handler::error(500, $e->getCode(), $e->getMessage(), $this->json );
      $data=$this->data('destroy', $redirect, false, 500);
      return $this->return($redirect, $data, $this->json);
      //-----------------------
    }
  }
  
  
  /**
  * Populate fields
  *
  *
  */
  private function populateFields($request, $action){
      
    foreach ($this->config["rows"] as $inputRow) {
      switch ($inputRow["type"]) {
        case 'string':
          $value = ( $request->input($inputRow["name"]) ) ? $request->input($inputRow["name"]) : NULL;

          break;
        case 'numeric':
          $value = ( $request->input($inputRow["name"]) || substr($inputRow["name"],-3) == '_id' ) ? $request->input($inputRow["name"]) : 0;

          break;
        case 'ipAddress':
          $value = $request->ip();

          break;
        case 'userAgent':
          $value = $request->header('User-Agent');

          break;
        case 'time':
          $value = ($request->input($inputRow["name"])) ? date("H:i:s", strtotime($request->input($inputRow["name"]))) : NULL;                            
          break;
        case 'date':
          $value = ($request->input($inputRow["name"])) ? date("Y-m-d", strtotime($request->input($inputRow["name"]))) : NULL;                            
          break;
        case 'datetime':
          $value = ($request->input($inputRow["name"])) ? date("Y-m-d H:i:s", strtotime($request->input($inputRow["name"]))) : NULL;                            
          break;
        case 'boolean':
          $value = ($request->input($inputRow["name"])) ? 1 : 0;
          
          break;
        case 'file':
            
          if($this->config["typeStorage"]=='single'){

            if($request->file($inputRow["name"])){
                
              $file_path = $this->saveFile($request, $this->config["fileStoragePath"], $inputRow["name"]);
                  
              if($file_path){
                  
                $fields[$inputRow["name"]] = 'storage/'.$file_path;

                foreach ($inputRow["fileFieldsInfo"] as $inputRowFile) {

                  if($inputRowFile["content"]=='file_name'){
                    $fields[$inputRowFile["name"]] = $request->file($inputRow["name"])->getClientOriginalName();
                  }elseif($inputRowFile["content"]=='file_extension'){
                    $fields[$inputRowFile["name"]] = strtolower( File::extension( $request->file($inputRow["name"])->getClientOriginalName() ) );
                  }else{
                    //-----------------------
                    $redirect = redirect()->route($this->config["route"].'.index')->with('error', $this->config["title-msg"].' invalid content type to storage on field '.$inputRowFile["name"]);
                    $data=$this->data('populateFields', $redirect, false, 500);
                    return $this->return($redirect, $data, $this->json);
                    //-----------------------
                  }
                }
              }        
            }

          }elseif($this->config["typeStorage"]=='complex'){



          }else{
            //-----------------------
            $redirect = redirect()->route($this->config["route"].'.index')->with('error', $this->config["title-msg"].' invalid typeStorage P001');
            $data=$this->data('populateFields', $redirect, false, 500);
            return $this->return($redirect, $data, $this->json);
            //-----------------------
          }
          break;
      }

      if($inputRow["type"]!='file'){
        if($value || $value===0 || $value===null){
          $fields[$inputRow["name"]] = $value;
        }
      }
    }

    return $fields;
  }
  
  
  /**
  * Save file
  *
  *
  */
  private function saveFile(Request $request, $pathStorage, $inputName)
  {
    return Storage::putFileAs($pathStorage, $request->file($inputName), $request->file($inputName)->getClientOriginalName() ); 
  }
  
  
  /**
  * Save multi file
  *
  *
  */
  private function saveMultiFile($parentId, $request)
  {
    if($this->config["typeStorage"]=='complex'){

      foreach ($this->config["rows"] as $inputRow) {
        if($inputRow["type"]=='file'){
          if($files = $request->file($inputRow["name"])){
            foreach($files as $file){
              if( $file_path = Storage::putFileAs($this->config["fileStoragePath"], $file, $file->getClientOriginalName() ) ){
                $rows = [];
                foreach ($inputRow["fileFieldsInfo"] as $inputRowFile) {

                  if($inputRowFile["content"]=='parent_id'){
                    $rows[$inputRowFile["name"]] = $parentId;
                  }elseif($inputRowFile["content"]=='file_url'){
                    $rows[$inputRowFile["name"]] = 'storage/'.$file_path;
                  }elseif($inputRowFile["content"]=='file_name'){
                    $rows[$inputRowFile["name"]] = $file->getClientOriginalName();
                  }elseif($inputRowFile["content"]=='file_extension'){
                    $rows[$inputRowFile["name"]] = strtolower( File::extension( $file->getClientOriginalName() ) );
                  }else{
                    //-----------------------
                    $redirect = redirect()->route($this->config["route"].'.index')->with('error', $this->config["title-msg"].' invalid content type to storage on field '.$inputRowFile["name"]);
                    $data=$this->data('saveMultiFile', $redirect, false, 500);
                    return $this->return($redirect, $data, $this->json);
                    //-----------------------
                  }
                }
                $this->config["storageModel"]::create($rows);
              }; 
            }
          }
        }   
      }

    }else{
      //-----------------------
      $redirect = redirect()->route($this->config["route"].'.index')->with('error', $this->config["title-msg"].' invalid typeStorage M001');
      $data=$this->data('saveMultiFile', $redirect, false, 500);
      return $this->return($redirect, $data, $this->json);
      //-----------------------
    }
  }
  
  
  /**
  * Build response
  *
  *
  */
  private function buildResponse($message, $data, $status, $code)
  {
    $response = [ 
      'message' => $message, 
      'data' => $data, 
      'status' => $status, 
      'code' => $code, 
    ];
    return $response;
  }
  
  
  /**
  * Json response
  *
  *
  */
  protected function jsonResponse($message, $data, $status, $code){
    return response()->json( 
      $this->buildResponse($message, $data, $status, $code), 
      $code 
    );
  }
  
  
  /**
  * Data
  *
  *
  */
  protected function data($message='', $values='', $status=false, $code=500){
    return $data=[ 'message' => $this->config["permission"].'-'.$message, 'values' => $values, 'status' => $status, 'code' => $code ];
  }
  
  
  /**
  * Return
  *
  *
  */
  private function return($redirect='', $data='', $json=false){

    if($json){
      return $this->jsonResponse($data['message'], $data['values'], $data['status'], $data['code']); 
    }else{
      return $redirect;
    }

  }


}