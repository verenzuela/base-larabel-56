<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class IndexController extends Controller {
  
  /**
  * Index page
  *
  *
  */
  public function index() {

    return redirect()->route('admin.index');

  }  

}
