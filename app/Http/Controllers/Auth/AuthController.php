<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Session;
use Auth;

class AuthController extends Controller {

  use AuthenticatesUsers;

  /**
   * Create a new authentication controller instance.
   *
   * @param  \Illuminate\Contracts\Auth\Guard  $auth
   * @return void
   */
  public function __construct(Guard $auth)
  {
    $this->auth = $auth;
    $this->middleware('guest', ['except' => 'getLogout']);
  }


  private function buildResponse($message, $data, $status, $code){
    $response = [ 
      'message' => $message, 
      'data' => $data, 
      'status' => $status, 
      'code' => $code, 
    ];
    return $response;
  }


  protected function jsonResponse($message, $data, $status, $code){
    return response()->json( 
      $this->buildResponse($message, $data, $status, $code), 
      $code 
    );
  }


  public function loginModalShow($async=false, $from=false) {
    return view('web.auth.login-modal', ['async' => $async, 'from' => $from] );
  }

  
  public function loginModal(Request $request, $from=false) {
    $this->validate($request, [
      'email' => 'required|email', 
      'password' => 'required',
    ]);

    $async = ($request['async']) ? $request['async'] : false;

    $oldSessionId = Session::getId();
    $credentials = $request->only('email', 'password');
    $loginAttempt = $this->auth->attempt($credentials, $request->has('remember'));
    
    if ($loginAttempt){ 
      $newSessionId = Session::getId();
      
      $data = [
        'from' => $from,
        'async'=> $async,
      ];      
      return $this->jsonResponse($message='login_success', $data, $status=true, $code=200);  
    }

    $data = [
      'errors' => __('error.user_password_incorrect'),
    ];
    return $this->jsonResponse($message='login_fail', $data, $status=false, $code=500);
  }


  public function registerModalShow($async=false, $from=false) {
    return view('web.auth.register-modal', ['async' => $async, 'from'=>$from] );
  }


  public function registerModal(Request $request, $from=false) {
    $this->validate($request, [
      'name' => 'required|max:255', 
      'email' => 'required|email|max:255|unique:users', 
      'password' => 'required|min:8|confirmed',
    ]);

    $user = User::create([
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
      'type_user' => 'frontend',
    ]);

    if($user){
      $user->roles()->attach(Role::where('name', 'customer')->first());
      $userAutentication = Auth::loginUsingId($user->id);

      $data = [
        'from' => $from,
      ];
      return $this->jsonResponse($message='register_success', $data, $status=true, $code=200);
    }
    

    $data = [
      'errors' => __('error.register_fail'),
    ];
    return $this->jsonResponse($message='register_fail', $data, $status=false, $code=500);
  }

}