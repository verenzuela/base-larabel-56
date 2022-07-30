<?php 

namespace App;

use Zizaco\Entrust\EntrustRole;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Validator;

class Role extends EntrustRole implements AuditableContract
{
  use Auditable;

  protected $table = 'roles';

  protected $guarded = [];

  public $errors;

  public function validateSaving(array $attributes = []){
    $validator = Validator::make($attributes, [
      'name' => 'required',
      'name' => 'unique:roles,name,'.$this->id,
      'display_name' => 'required',
    ]);        
    $this->errors = $validator->errors();
    return $validator->passes();
  }

}