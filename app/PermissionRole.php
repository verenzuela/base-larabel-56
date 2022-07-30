<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class PermissionRole extends Model implements AuditableContract
{
  use Auditable;
  
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'permission_role';
  
  /**
  * The attributes that aren't mass assignable.
  *
  * @var array
  */
  protected $guarded = [];
}
