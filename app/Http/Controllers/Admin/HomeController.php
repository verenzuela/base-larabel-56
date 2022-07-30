<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ShopiliteApi;
use Illuminate\Http\Request;
use App\Helpers\Format;
use App\WebSetting;
use Session;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware(['auth', 'BlackList']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  { if( $request->user()->hasRole(['root', 'admin']) ){
      return view('admin.home.page');

    }elseif( $request->user()->hasRole(['customer']) ){
      return view('admin.home.page');
      
    }else{
      return redirect()->route('web.index');
    };
      
  }
}
