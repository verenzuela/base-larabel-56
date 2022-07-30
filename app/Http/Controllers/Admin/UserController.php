<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Helpers\HtmlElement;
use App\Exceptions\Handler;
use App\Helpers\Image;
use App\RentalUser;
use App\RoleUser;
use App\Rental;
use App\Domain;
use App\User;
use App\Role;
use Password;
use Auth;
use DB;

class UserController extends Controller
{   
  public function __construct(){
    $this->middleware(['auth', 'BlackList']);
    $this->paramsToView['render'] = new HtmlElement();
    $this->image = new Image();
  }


  /**
  *
  *
  *
  */
  private function buildResponse($message, $data, $status, $code){
    $response = [ 
      'message' => $message, 
      'data' => $data, 
      'status' => $status, 
      'code' => $code, 
    ];
    return $response;
  }

  /**
  *
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
  *
  *
  *
  */
  private function validateInput($request, $userType='backend'){
    if($userType=='backend'){
      $this->validate($request, [
        'name'      => 'required|max:50',
        'email'     => 'required',
        'role_id'   => 'required',
      ]);
    }else{
      $this->validate($request, [
        'email' => 'required',
        'role_id' => 'required',
        'firstname' => 'max:30',
        'lastname' => 'max:30',
        'phone' => 'max:20',
        'address' => 'max:50',
        'zip_code' => 'max:20',
        'country' => 'max:100',
        'country' => 'max:100',
        'country_code' => 'max:5',
        'city' => 'max:100',
      ]);
    }
  }

  /**
  *
  *
  *
  */
  private function rolesList($userType='backend'){
    if($userType=='backend'){
      if( Auth::user()->hasRole(['root']) ){
        return Role::where('name', '!=', '')->pluck('name', 'id')->map(function ($item, $key) { return trans('admin.' . $item . ''); })->prepend( __('admin.choose'), '' );
      }else{
        return Role::where('name', '!=', '')->where('name', '!=', 'root')->pluck('name', 'id')->map(function ($item, $key) { return trans('admin.' . $item . ''); })->prepend( __('admin.choose'), '' );
      }
    }else{
      return Role::where('name', '!=', '')->whereIn('name', array('customer') )->pluck('name', 'id')->map(function ($item, $key) { return trans('admin.' . $item . ''); })->prepend( __('admin.choose'), '' );
    }
  }

  /**
  *
  *
  *
  */
  private function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  /**
  *
  *
  *
  */
  public function userList($userType){   
    try {
      if( Auth::user()->can('user-list') ){

        $this->paramsToView['users'] =  User::where('type_user','=',$userType)->orderBy('id', 'desc')->paginate(10);

        if($userType=='backend'){
          return view('admin/user/index', $this->paramsToView);
        }else{
          return view('admin/customer/index', $this->paramsToView);
        }

      }else Handler::error(403, 401);
        
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function userCreate($userType){   
    try {
      if( Auth::user()->can('user-create') ){
        if($userType=='backend'){
          $this->paramsToView['rolesList'] =  $this->rolesList();
          return view( 'admin/user/create', $this->paramsToView );
        }else{
          $this->paramsToView['rolesList'] =  $this->rolesList('frontend');
          return view( 'admin/customer/create', $this->paramsToView );
        }
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){   
    try {
      if( Auth::user()->can('user-create') ){

        $this->validateInput($request, $request['type_user']);
        $this->validate($request, [
          'email'     => 'required|email:rfc,dns|unique:users',
        ]);

        $user = new User();
        $user->name         = ($request['type_user']=='frontend') ? $request['firstname'] : $request['name'];
        $user->email        = $request['email'];

        if(!$request['generate_password']){
          $this->validate($request, [ 'password' => 'required|string|min:8', ]);  
          $user->password     = bcrypt($request['password']);
        }else{
          $user->password = Password::getRepository()->create($user);
        }
        
        $user->type_user    = $request['type_user'];
        $user->firstname    = $request['firstname'];
        $user->lastname     = $request['lastname'];
        $user->phone        = $request['phone'];
        $user->address      = $request['address'];
        $user->zip_code     = $request['zip_code'];
        $user->country      = $request['country'];
        $user->country_code = $request['country_code'];
        $user->city         = $request['city'];
        
        try{
          
          $user->save();

          $userRole = new RoleUser();
          $userRole->user_id = $user->id;
          $userRole->role_id = $request['role_id'];
            
          //atach domain, some issues if no attach
          $domain  = Domain::where('name', env('APP_DOMAIN'))->first();
          $user->domains()->attach($domain);    

          try{
            $userRole->save();
            return Redirect()->route('users.edit', [ 'user' => $user->id ])->with('status', __('admin.data_add_success', [ 'object' => __('admin.user') ])  );
          } catch (\Illuminate\Database\QueryException $e) {
            Handler::error(500, $e->getCode(), $e->getMessage().' Saving UserRole '  );
          };

        } catch (\Illuminate\Database\QueryException $e) {
          Handler::error(500, $e->getCode(), $e->getMessage().' Saving User '  );
        };

      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id){   
    try {
      if( Auth::user()->can('user-edit') ){
          
        $this->paramsToView['user'] = $user = User::findOrFail($id);

        if($user->type_user == 'backend'){
          $this->paramsToView['rolesList'] =  $this->rolesList();
          return view('admin/user/edit', $this->paramsToView);
        }else{
          $this->paramsToView['rolesList'] =  $this->rolesList('frontend');
          return view('admin/customer/edit', $this->paramsToView);
        }
      }else Handler::error(403, 401);

    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }  
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    try {
      if( Auth::user()->can('user-edit') ){
          
        $this->validateInput($request, $request['type_user']);
        
        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        
        $user->name         = ($request['type_user']=='frontend') ? $request['firstname'] : $request['name'];
        $user->email        = $request['email'];
        if( $request['password']!='' ) $user->password = bcrypt($request['password']);

        $user->firstname    = $request['firstname'];
        $user->lastname     = $request['lastname'];
        $user->phone        = $request['phone'];
        $user->address      = $request['address'];
        $user->zip_code     = $request['zip_code'];
        $user->country      = $request['country'];
        $user->country_code = $request['country_code'];
        $user->city         = $request['city'];

        if( count($user->roles) != 0 ){
          if( $request['role_id'] != $user->roles[0]->id ){
            $roleUser = RoleUser::where("user_id",$user->id)->first();
            $userRole = RoleUser::find($roleUser->id);
            $userRole->role_id = $request['role_id'];

            try{
              $userRole->save();
            } catch (\Illuminate\Database\QueryException $e) {
              Handler::error(500, $e->getCode(), $e->getMessage().' Saving UserRole 001' );
            };
          } 
        }else{
          $userRole = new RoleUser();
          $userRole->user_id = $user->id;
          $userRole->role_id = $request['role_id'];
          
          try{
            $userRole->save();
          } catch (\Illuminate\Database\QueryException $e) {
            Handler::error(500, $e->getCode(), $e->getMessage().' Saving UserRole 002' );
          };
        }

        #update user
        try{
          $user->update();
          return Redirect()->route('users.edit', [ 'user' => $user->id ])->with('status', __('admin.data_updated_success', [ 'object' => __('admin.user') ]) );
        } catch (\Illuminate\Database\QueryException $e) {
          Handler::error(500, $e->getCode(), $e->getMessage().' Saving User' );
        };
      
      }else Handler::error(403, 401);

    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id){   
    try {
      if( Auth::user()->can('user-delete') ){

        $user = User::findOrFail($id);
        $type_user = $user->type_user;
        
        #delete current rol
        if(count($user->roles) > 0)
          $user->roles()->detach($user->roles[0]->id);

        #delete current assigned domain
        if(count($user->domains) > 0)
          $user->domains()->detach($user->domains[0]->id);


        #dele user
        try{
          $user->delete();
          return Redirect()->route('user.type.list', ['userType'=>$type_user] );
        } catch (\Illuminate\Database\QueryException $e) {
          Handler::error(500, $e->getCode(), $e->getMessage());
        }

      }else Handler::error(403, 401);

    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function updateProfile(Request $request, $id)
  {
    try {
      if ( Auth::user()->can('user-edit') ){
          $user = User::findOrFail($id);
          $user->name = $request['firstname'].' '.$request['lastname'];
          $user->firstname = $request['firstname'];
          $user->lastname = $request['lastname'];
          $user->phone = $request['phone'];

          if ($request['img_url']) {
            if ($user->img_url) {
              $this->image::storageDelete($user->img_path);
            }

            $data = $this->image::upload($request, 'profile_user_img', 'img_url');
            if ($data) {
              $user->img_url = $data["img_url"];
              $user->img_path = $data["img_path"];
              $user->img_name = $data["fileName"];
              $user->img_type = $data["extension"];
            }
          }
          
          #update user
          try {
            $user->update();
            return Redirect()->route('user.profile', [ 'user' => $user->id ])->with('status', 'Profile updated successfully...');
          } catch (\Illuminate\Database\QueryException $e) {
            Handler::error(500, $e->getCode(), $e->getMessage().' Saving User');
          };
      } else {
        Handler::error(403, 401);
      }
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function userProfile($userId){
    try {
      if( Auth::user()->can('user-settings') ){

        $user = User::findOrFail($userId);
        $this->paramsToView['user'] = $user;
        $this->paramsToView['nameArr'] = explode(" ", $user->name);

        return view('admin/user/settings-profile', $this->paramsToView);

      }else  Handler::error(403, 401);

    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function userAccount($userId){
    try {
      if( Auth::user()->can('user-settings') ){
        



        $this->paramsToView['user'] = User::findOrFail($userId);
        return view('admin/user/settings-account', $this->paramsToView);

      }else Handler::error(403, 401);

    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function updateUserSecurity(Request $request, $id)
  {
    try {
      if ( Auth::user()->can('user-edit') ){
        $this->validate($request, [
          'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request['password']);
          
        #Update user
        try {
          $user->update();
          return Redirect()->route('user.security', [ 'user' => $user->id ])->with('status', 'Password updated successfully...');
        } catch (\Illuminate\Database\QueryException $e) {
          Handler::error(500, $e->getCode(), $e->getMessage().' Saving User');
        };
      } else {
        Handler::error(403, 401);
      }
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function userSecurity($userId){
    try {
      if( Auth::user()->can('user-settings') ){        
        $this->paramsToView['user'] = User::findOrFail($userId);
        return view('admin/user/settings-security', $this->paramsToView);
      }else Handler::error(403, 401);
    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function userNotifications($userId){
    try {
      if( Auth::user()->can('user-settings') ){
        $this->paramsToView['user'] = User::findOrFail($userId);
        return view('admin/user/settings-notifications', $this->paramsToView);
      }else Handler::error(403, 401);
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
  *
  *
  *
  */
  public function getInfoJson(Request $request, $id){
    try {
      if( Auth::user()->can('user-settings') ){
        $user = User::find($id);
        if($user){
          $customerInfo = $user->getInfo();
          if($customerInfo){
            $data = $customerInfo;
            return $this->jsonResponse('user_info', $data, true, 200);
          }else{
            return $this->jsonResponse('error_retrieving_user_info', false, false, 500);
          }
        }else{
          return $this->jsonResponse('user_not_found', false, false, 404);
        }
      }else return $this->jsonResponse('unauthorized', false, false, 403);
    } catch (Exception $e) {
      return $this->jsonResponse($e->getMessage(), false, false, $e->getCode());
    }  
  }
    


}
