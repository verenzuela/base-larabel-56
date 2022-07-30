<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Mailer;
use App\Helpers\Logo;
Use App\User;
use Password;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest');
    }

    public function showLinkRequestForm(){

        $logo = new Logo();
        $headerLogo = $logo->header();

        return view('web.auth.passwords.email', [ 'logo' => $headerLogo ]);
    }

    public function sendResetLinkEmail(Request $request){   
        $this->validateEmail($request);
        $mailer = new Mailer();

        $token = str_random(60);
        $hashToken = \Hash::make($token);

        DB::delete('delete from password_resets where email = ?',[$request->email]);
        DB::table('password_resets')->insert([ 'email' => $request->email, 'token' =>$hashToken, 'created_at' => now() ]);
        $request = DB::table('password_resets')->where('email', $request->email)->first();

        if($token){
            $mailer->userResetPassword($request->email, $token);
            return redirect()->route('password.request')->with('status', 'We have e-mailed your password reset link! ');
        }else{
            return view('web.auth.passwords.email');
        }
    }
    
}
