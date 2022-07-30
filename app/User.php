<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Foundation\Auth\User as ModelAuthenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use App\Helpers\Format;
use App\Helpers\Mailer;
use Auth;

class User extends ModelAuthenticatable implements Authenticatable, CanResetPasswordContract, AuditableContract
{   
  use AuthenticableTrait;
  use Notifiable;
  use CanResetPassword;
  use Auditable;
  use EntrustUserTrait;
    
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  public $errors;

  protected $new_user = false;
  
  public function roles(){ return $this->belongsToMany(Role::class); }
  public function domains(){ return $this->belongsToMany(Domain::class); }
  
  protected $mailer;

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function generateTags(): array
  {   
    if($this->isDirty('last_login_at')){
        return [ 'Login' ];
    }else{
        return [ Null ];
    }
  }
  
  protected static function boot(){
    parent::boot();
    static::saving(function ($model) {
      $model->onSaving();
    });
    static::created(function ($model) {
      $model->onCreated(); 
    });
  }

  protected function onSaving(){
    if (!$this->exists){
      $this->new_user = true;
    }
  }

  protected function onCreated(){

    // Send  e-mails whit credentials to the user
    if($this->email != env('USER_ROOT') && $this->email != env('USER_ADMIN') ){

      //Object to send email
      $this->mailer = new Mailer();

      if ($this->new_user) {
        $this->refresh();
        if($this->email != ''){
          if($this->type_user == 'backend'){
            $this->mailer->userWelcomeEmail($this);    
          } 
        }
      }
    }
       
    return $this;
  }

  public function getInfo(){

    if ( !Auth::check() ) return false;

    $firstname = ($this->firstname) ? $this->firstname : $this->name;
    $lastname = ($this->lastname) ? $this->lastname : '';
    $email = ($this->email) ? $this->email : '';
    $phone = ($this->phone) ? $this->phone : '';
    $userInfoHtml = "<p class='p-user-info'><b>Firstname:</b> $firstname</p>
                    <p class='p-user-info'><b>Lastname:</b> $lastname</p>
                    <p class='p-user-info'><b>Email:</b> $email</p>
                    <p class='p-user-info'><b>Phones:</b> $phone</p>";

    $userInfo = [
      'id' => $this->id,
      'name' => $this->name,
      'fullname' => $this->fullname,
      'firstname' => $this->firstname,
      'lastname' => $this->lastname,
      'phone' => $this->phone,
      'email' => $this->email,
      'format_html' => Format::minifyHtml($userInfoHtml),
    ];

    return [
      'userInfo' => $userInfo
    ];
  }


}
