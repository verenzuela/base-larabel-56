<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class WebSetting extends Model implements AuditableContract
{
  use Auditable;

  protected $table = 'web_settings';

  protected $guarded = [];

  public function domains(){ return $this->belongsTo('App\Domain', 'domain_id', 'id'); }

}
