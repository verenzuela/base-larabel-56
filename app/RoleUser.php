<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class RoleUser extends Model implements AuditableContract
{
  use Auditable;
  
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'role_user';
  
  /**
  * The attributes that aren't mass assignable.
  *
  * @var array
  */
  protected $guarded = [];
}
