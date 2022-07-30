<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Jobs\SendEmailJob;
use Auth;
use Carbon\Carbon;
use App\Email as ModelEmail;
use App\Reservation;
use App\WebSetting;
use App\Helpers\Info;
use Stackkit\LaravelDatabaseEmails\Email;


class EmailController extends Controller
{ 
  public function __construct()
  {
    $this->middleware(['auth', 'BlackList']);
  }
    
  public function sendEmail()
  {
    
    Email::compose()
      ->label('welcome')
      ->recipient('verenzuela@gmail.com')
      ->subject('This is a test')
      ->from('john@doe.com')
      ->view('layouts.email.test')
      ->variables([
        'name' => 'Andrés Verenzuela',
      ])
    ->send();

    echo 'email sent ';
  }


  public function index()
  { 
    try {
        if( Auth::user()->hasRole(['root']) ){

          $emailLogs = ModelEmail::orderBy('id', 'desc')->paginate(10);
          return view('admin/tools/email_log/index', ['emailLogs' => $emailLogs]);

        }else Handler::error(403, 401);
        
    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }


  public function show($id)
  { 
    try {
      if( Auth::user()->hasRole(['root']) ){

        $emailLog = ModelEmail::findOrFail($id);
        return view('admin/tools/email_log/show', ['emailLog' => $emailLog]);

      }else Handler::error(403, 401);
        
    } catch (Exception $e) {
      Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }


  public function preview()
  { 
    try {
      if( Auth::user()->hasRole(['root']) ){

        /*
        return view('layouts/email/hotel_reservation_cancel', [ 
          'reservation' => Reservation::firstOrFail(), 
          'info'=> new Info(), 
          'title'=> 'title', 
          'webSettings' => WebSetting::firstOrFail(), 
        ] );
        */ 
        /*
        $data['payment_method'] = 'PayPal';
        $data['email'] = 'verenzuela@gmail.com';
        $data['transaction_id'] = 'hhfhfus8y9hod';
        $data['date'] = date("l d, Y");
        $data['amount'] = '20 USD';

        return view('layouts/email/donation_success', [ 
          'data' => $data, 
          'title' => 'suscription',
          'subject' => 'suscription',
        ] );
        */


        

      }else Handler::error(403, 401);
        
    } catch (Exception $e) {
        Handler::error(500, $e->getCode(), $e->getMessage());
    }
  }


}
