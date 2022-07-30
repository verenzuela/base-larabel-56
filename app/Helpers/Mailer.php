<?php

namespace App\Helpers;
use Stackkit\LaravelDatabaseEmails\Email;
use App\Helpers\Format;
use App\Helpers\Info;
use App\WebSetting;
use App\Theme;
use App\User;
use DB;

class Mailer {

  /**
  *
  *
  *
  */
  public function __construct(){
    $this->webSettings = WebSetting::firstOrFail();
    $this->theme = Theme::where('status', 1)->first();
    $this->info = new Info();
  }

  /**
  *
  *
  *
  */
  protected function send($label, $recipient, $subject, $template, $varToTemplate=[], $fromEmail=false, $file=null ){
  	Email::compose()->label($label)->recipient($recipient)->subject($subject)->from( (!$fromEmail) ? $this->info::senderEmail() : $fromEmail )->view($template)->variables($varToTemplate)->attach($file)->send();
  }

  /**
  *
  *
  *
  */
  public function userWelcomeEmail(User $user){
    $title = __('email.user.welcome', ['app_name' => env('APP_NAME')] );
    $subject = __('email.user.welcome', ['app_name' => env('APP_NAME')] );

    $token = DB::table('password_resets')->where('email','=', $user->email)->first();

    $template = 'layouts.email.user_welcome';
    $varToTemplate = [
      'theme' => $this->theme,
      'team_name' => __('email.the_team', ['team_name' => env('APP_NAME')]),
      'store_legal_name' => ($this->webSettings->supplier_name) ? $this->webSettings->supplier_name : env('APP_NAME'),
      'domain_url' => env('APP_DOMAIN'),
      'email_support' => $this->info::infoEmail(),
      'user' => $user, 
      'token' => $token, 
      'info' => $this->info,
      'webSettings' => $this->webSettings,
      'title' => $title,
      'subject' => $subject,
    ];

    $this->send('user_welcome', $user->email, $subject, $template, $varToTemplate);
  }

}