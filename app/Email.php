<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
  protected $collection = 'emails';

  protected $dates = [
    'scheduled_at',
    'sent_at',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  public function getFromAttribute($value)
  {   
    return json_decode($value);
  }
  
}