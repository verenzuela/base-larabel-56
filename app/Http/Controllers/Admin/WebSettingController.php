<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ShopiliteApi;
use App\Helpers\HtmlElement;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use LaravelLocalization;
use App\DomainUser;
use App\WebSetting;
use App\Domain;
use Session;
use Auth;

class WebSettingController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'BlackList']);
    $this->paramsToView['render'] = new HtmlElement();
  }

  private function buildResponse($message, $data, $status, $code)
  {
    $response = [ 
      'message' => $message, 
      'data' => $data, 
      'status' => $status, 
      'code' => $code, 
    ];
    return $response;
  }

  protected function jsonResponse($message, $data, $status, $code){
    return response()->json( 
      $this->buildResponse($message, $data, $status, $code), 
      $code 
    );
  }

  public function index()
  {
    try {
      if( Auth::user()->can('web-config-list') ){
        return view('admin.settings.index');
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  public function indexWebSettings()
  {
    try {
      if( Auth::user()->can('web-config-list') ){

        $domainId = (Session::get('domainId')) ? Session::get('domainId') : 1;
        $this->paramsToView['domain'] = $domain = Domain::find($domainId);
        $this->paramsToView['webSetting'] = WebSetting::find($domain->websettings->id);
        $this->paramsToView['locales'] = LaravelLocalization::getSupportedLocales();

        return view('admin.settings.web.edit', $this->paramsToView);
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  public function indexBookingPolicy()
  {
    try {
      if( Auth::user()->can('booking-policy-list') ){
        $this->paramsToView['domain'] = $domain = Domain::find(Session::get('domainId'));
        $this->paramsToView['webSetting'] = WebSetting::find($domain->websettings->id);
        return view('admin.settings.bookingPolicy.edit', $this->paramsToView);
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  public function indexBillingInfo()
  {
    try {
      if( Auth::user()->can('billing-info-list') ){
        $this->paramsToView['domain'] = $domain = Domain::find(Session::get('domainId'));
        $this->paramsToView['webSetting'] = WebSetting::find($domain->websettings->id);
        return view('admin.settings.billingInfo.edit', $this->paramsToView);
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  public function indexTelegramInfo()
  {
    try {
      if( Auth::user()->can('telegram-edit') ){
        $this->paramsToView['domain'] = $domain = Domain::find(Session::get('domainId'));
        $this->paramsToView['webSetting'] = WebSetting::find($domain->websettings->id);
        return view('admin.settings.telegram.edit', $this->paramsToView);
      }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  public function indexWhatsAppInfo()
  {
    try {
      if( Auth::user()->can('whatsapp-edit') ){
        $domainId = ( Session::get('domainId') ) ? Session::get('domainId') : 1;
        $this->paramsToView['domain'] = $domain = Domain::find( $domainId );
        $this->paramsToView['webSetting'] = WebSetting::find( $domain->websettings->id );
        return view('admin.settings.whatsapp.edit', $this->paramsToView);
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
      if( Auth::user()->can('web-config-create') ){
          
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
   * Show the form for editing the specified resource.$domain = Domain::findOrFail($id);
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    try {
      if( Auth::user()->can('web-config-edit') ){
          
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
        
      $webSetting = WebSetting::findOrFail($id);
      if($webSetting){
        switch ($request['typeSettings']) {
          case 'web':
            if( Auth::user()->can('web-config-edit') ){
              $webSetting->adm_url = $request['adm_url'];
              $webSetting->web_url = $request['web_url'];
              $webSetting->api_url = $request['api_url'];
              $webSetting->randomize_homepage_slideshow = ($request['randomize_homepage_slideshow']) ? 1 : 0;        
            }else Handler::error(403, 401);

            break;
          case 'bookingPolicy':
            if( Auth::user()->can('booking-policy-edit') ){
              $webSetting->booking_policy_general = $request['booking_policy_general'];
              $webSetting->booking_policy_non_refundable = $request['booking_policy_non_refundable'];
              $webSetting->booking_policy_refundable = $request['booking_policy_refundable'];
            }else Handler::error(403, 401);

            break;
          case 'billing':
            if( Auth::user()->can('billing-info-edit') ){
              $webSetting->supplier_name = $request['supplier_name'];
              $webSetting->supplier_address = $request['supplier_address'];
              $webSetting->supplier_tax_id = $request['supplier_tax_id'];
              $webSetting->supplier_bank_name = $request['supplier_bank_name'];
              $webSetting->supplier_bank_account = $request['supplier_bank_account'];
              $webSetting->supplier_routing_number = $request['supplier_routing_number'];
            }else Handler::error(403, 401);

            break;

          case 'telegram':
            if( Auth::user()->can('telegram-edit') ){
              $webSetting->telegram_token = $request['telegram_token'];
              $webSetting->telegram_id  = $request['telegram_id'];
              $webSetting->enabled_telegram_notifications = ($request['enabled_telegram_notifications']) ? 1 : 0;
            }else Handler::error(403, 401);

            break;

          case 'whatsapp':
            if( Auth::user()->can('whatsapp-edit') ){
              $webSetting->whatsapp_token = $request['whatsapp_token'];
              $webSetting->whatsapp_phone_number  = $request['whatsapp_phone_number'];
              $webSetting->enabled_whatsapp_notifications = ($request['enabled_whatsapp_notifications']) ? 1 : 0;
            }else Handler::error(403, 401);

            break;
        }

        try{
          $webSetting->save();
          return redirect()->route('web-settings.index')->with('status', __('admin.data_updated_success', ['object' => __('admin.label.settings') ]) );
        } catch (\Illuminate\Database\QueryException $e) {
          Handler::error(500, $e->getCode(), $e->getMessage());
        };

      }else return redirect()->route('web-settings.index')->with('error', __('admin.data_no_exist', ['object' => __('admin.label.settings') ]) );

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
        if( Auth::user()->can('web-config-delete') ){

        }else Handler::error(403, 401);

    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }

  public function setEmailSendingStatus($status)
  {
    try {
      if( Auth::user()->can('web-config-edit') ){

        $webSetting = WebSetting::find(1);
        $webSetting->enable_email_sending = $status;

        if($webSetting->save()){
          return $this->jsonResponse(__('email_sending_updated'), false, true, 200);
        }else{
          return $this->jsonResponse(__('error_updating_email_sendig_status'), $webSetting->errors, false, 500);
        };

      }else{
        return $this->jsonResponse('unauthorized', false, false, 403);
      }

    } catch (Exception $e) {
      return $this->jsonResponse(__('error_email_sendig_status'), array('code'=>$e->getCode(), 'msg'=>$e->getMessage()), false, 500);
    }

  }

}
