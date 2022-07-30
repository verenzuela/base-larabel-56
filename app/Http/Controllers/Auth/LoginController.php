<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Logined;
use App\DomainUser;
use App\Domain;
use Redirect;
use Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    { 
      $this->auth = $auth;
      $this->middleware('guest')->except('logout');
    }


    public function login(Request $request){
      $this->validate($request, [
        'email' => 'required|email', 
        'password' => 'required',
      ]);

      $oldSessionId = Session::getId();
      $credentials = $request->only('email', 'password');
      $loginAttempt = $this->auth->attempt($credentials, $request->has('remember'));

      if ($loginAttempt){ 
        $newSessionId = Session::getId();
        $this->authenticated($request, Auth::user());

        if(Auth::user()->hasRole(['root', 'admin'])){
          return redirect('/admin');
        }else{
          return redirect($this->redirectTo);
        }
        
      }else{
        return  Redirect::back()->withInput($request->input())->withErrors([500 => __('auth.error.user_password') ]);
      } 
    }

    public function showLoginForm(){
      return view('web.auth.login');
    }

    protected function authenticated(Request $request, $user){
      event(new Logined());

      if($user->hasRole(['root', 'admin'])){

        $userDomain = DomainUser::where('user_id', $user->id)->first();
        $domain  = Domain::where('name', env('APP_DOMAIN'))->first();

        if($user->is_domain_admin){

          if(!$userDomain){
            if($user->id == 1){
              $newUserDomain = new DomainUser();
              $newUserDomain->user_id = $user->id;
              $newUserDomain->domain_id = $domain->id;
              $newUserDomain->save();

              Session(['domainId' => $newUserDomain->domain_id]);
              return;
            }else{
              Session(['domainId' => false]);
              return;
            }
          }else{
            Session(['domainId' => $userDomain->domain_id]);
            return;
          }
        }else{
          Session(['domainId' => $userDomain->domain_id]);
          return;
        }
      }
    }
}
