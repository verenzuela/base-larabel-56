<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
  protected $collection = 'audits';

  protected $dates = [
    'created_at',
    'updated_at',
  ];

  public function getUserName($userId){
  	return ($userId) ? User::findOrFail($userId)->name : '';
  }
  
  public function getColorAction($action){
    switch ($action) {
      case 'created':
        return 'green';
        break;
      case 'updated':
        return 'orange';
        break;
      case 'deleted':
        return 'red';
        break;
    }
  }

}
