<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class DomainUser extends Model implements AuditableContract
{
	use Auditable;

	protected $guarded = [];

	protected $table = 'domain_user';
}
