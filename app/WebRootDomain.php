<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class WebRootDomain extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'web_root_domains';

  protected $guarded = [];
  
  public function webSettings()
  {
    return $this->hasOne('App\WebSetting');
  }

}
