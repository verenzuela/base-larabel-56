<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Domain extends Model implements AuditableContract
{
	use Auditable;

	protected $table = 'domains';

	protected $guarded = [];

	public function websettings(){
  	return $this->hasOne('App\WebSetting');
	}


}
