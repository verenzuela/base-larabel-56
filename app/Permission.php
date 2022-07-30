<?php 

namespace App;

use Zizaco\Entrust\EntrustPermission;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Validator;

class Permission extends EntrustPermission implements AuditableContract
{
  use Auditable;

  protected $table = 'permissions';

  protected $guarded = [];

  public $errors;

  public function roles(){ return $this->belongsToMany(Role::class); }
  
  public function validateSaving(array $attributes = []){
    $validator = Validator::make($attributes, [
      'name' => 'required',
      'name' => 'unique:permissions,name,'.$this->id,
    ]);        
    $this->errors = $validator->errors();
    return $validator->passes();
  }

}