<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class [name_model_here] extends Model implements AuditableContract
{
    use Auditable;

    protected $guarded = [];

	protected $table = 'name_table_here';
	
}
