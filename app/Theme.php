<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use DB;

class Theme extends Model implements AuditableContract
{
	use Auditable;

	protected $guarded = [];

	protected $table = 'themes';

  /**
  *
  *
  *
  */
  protected static function boot(){
    parent::boot();
    static::saving(function ($model) {
      $model->onSaving();
    });
  }

  /**
  *
  *
  *
  */
  protected function onSaving(){
    if ($this->exists){
      if($this->isDirty('status')){
      	DB::table('themes')->where('status', '=', 1)->update(array('status' => 0));
      }
    }
  }

  /**
  *
  *
  *
  */
  public function getStatusPreview($status){
		switch ($status) {
		  case 0: return "<span class='badge badge-subtle badge-dark'>".__('admin.inactive')."</span>"; break;
		  case 1: return "<span class='badge badge-success'>".__('admin.active')."</span>"; break;
		}
	}
}