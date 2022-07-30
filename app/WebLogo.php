<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Validator;

class WebLogo extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'web_logos';

  protected $guarded = [];

  public $errors;

  public function webSetting(){ return $this->belongsTo('App\WebSetting'); }

  public function validateSaving(array $attributes = []){
    $validator = Validator::make($attributes, [

    ]);        
    $this->errors = $validator->errors();
    return $validator->passes();
  }
  
}
