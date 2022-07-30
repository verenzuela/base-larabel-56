<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Validator;

class BlackListEmail extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'blacklist_emails';

  protected $guarded = [];

  public $errors;
  
  public function validateSaving(array $attributes = []){
    $validator = Validator::make($attributes, [
      'email' => 'required|email:rfc,dns',
      'email' => 'unique:blacklist_emails,email,'.$this->id,
    ]);        
    $this->errors = $validator->errors();
    return $validator->passes();
  }
  
}
