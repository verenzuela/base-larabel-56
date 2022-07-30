<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Helpers\HtmlElement;
use Auth;
use Session;
use App\Domain;
use App\DomainUser;
use App\WebSetting;
use App\WebLogo;

class DomainController extends Controller
{   
  public function __construct(){
    $this->middleware(['auth']);
    $this->paramsToView['render'] = new HtmlElement();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      if( Auth::user()->can('domains-list') ){
        $domainIds = DomainUser::where('user_id', Auth::user()->id )->pluck('domain_id');
        $this->paramsToView['domains'] = Domain::whereIn('id', $domainIds)->orderBy('id','desc')->paginate(10);
        return view('admin.settings.domain.index', $this->paramsToView );
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    try {
      if( Auth::user()->can('web-config-create') ){
        return view('admin.settings.domain.create' );
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      if( Auth::user()->can('domains-create') ){
          
      }else Handler::error(403, 401);
        
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    try {
      if( Auth::user()->can('domains-create') ){
        $websetting = WebSetting::where('domain_id', $id )->get();
        $domain = Domain::find($id);

        $this->paramsToView['websetting'] = $websetting = WebSetting::where('domain_id', $id )->get();
        $this->paramsToView['domain'] = Domain::find($id);
        $this->paramsToView['countWebSettings'] = count($websetting);

        return view('admin.settings.domain.edit', $this->paramsToView ); 
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    try {
      if( Auth::user()->can('domains-edit') ){

        $domain = Domain::findOrFail($id);
        if($domain){
          //$this->validateInput($request);
          $domain->description= $request['description'];                
          $domain->ssl        = ( $request['ssl'] ) ? true : false;
          $domain->web_port   = $request['web_port'];
          $domain->ssl_port   = $request['ssl_port'];

          try{
            $domain->save(); //guardar dominio
            
            if( !$domain->websettings ){
              $webSettings = new WebSetting();
              $webSettings->domain_id = $domain->id;
              $webSettings->adm_url = $domain->name.'/admin';

              try{
                if($webSettings->save()){
                  $header = new WebLogo();
                  $header->name = 'Header Logo';
                  $header->web_setting_id = 1;
                  $header->img_url = 'images/favicon.ico';
                  $header->status = 1;
                  $header->save();

                  $footer = new WebLogo();
                  $footer->name = 'Footer Logo';
                  $footer->web_setting_id = 1;
                  $footer->img_url = 'images/favicon.ico';
                  $footer->status = 1;
                  $footer->save();

                  //guardar configuración websettings
                  return redirect()->route('domains.index');
                }
              } catch (\Illuminate\Database\QueryException $e) {
                Handler::error(500, $e->getCode(), $e->getMessage());
              };

            }else{
              return redirect()->route('domains.index');
            };

          } catch (\Illuminate\Database\QueryException $e) {
            Handler::error(500, $e->getCode(), $e->getMessage());
          };
        }else return redirect()->route('domains.index')->with('error','Domain not exist');
          
      }else Handler::error(403, 401);
        
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      if( Auth::user()->can('domains-delete') ){

      }else Handler::error(403, 401);
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

}
