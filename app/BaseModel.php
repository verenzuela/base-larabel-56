<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class BaseModel extends Model implements AuditableContract
{
	use Auditable;

	const STATUS_DISABLED = '0';
	const STATUS_ENABLED = '1';
	const STATUS_DELETED = '2';

	const INVENTORY_IN_STOCK = 'in_stock';
  const INVENTORY_SOLD_OUT = 'sold_out';
  const INVENTORY_ERROR = 'inventory_error';
  const IMAGE_BLANK = 'images/blank.png';

  
	/**
  *
  *
  *
  */
  public function getHtmlBadgeStatus(){
		switch ($this->status) {
			case self::STATUS_DISABLED: return "<span class='badge badge-dark'>" . __('admin.off') . "</span>"; break;
			case self::STATUS_ENABLED: return "<span class='badge badge-success'>" . __('admin.on') . "</span>"; break;
			case self::STATUS_DELETED: return "<span class='badge badge-danger'>" . __('admin.deleted') . "</span>"; break;
			return __('admin.unknown');
		}
	}
	
	
	/**
  *
  *
  *
  */
  public function getStatus(){
		if ($this->status == self::STATUS_DISABLED) return __('admin.disabled');
		if ($this->status == self::STATUS_ENABLED) return __('admin.enabled');
		if ($this->status == self::STATUS_DELETED) return __('admin.deleted');
		return __('admin.unknown');
	}


	/**
  *
  *
  *
  */
  protected function response($message, $data, $status, $code){
		return json_decode(json_encode([ 'message' => $message, 'data' => $data, 'status' => $status, 'code' => $code, ]));
	}
	
}