<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var array
   */
  protected $dontReport = [
    //
  ];

  /**
   * A list of the inputs that are never flashed for validation exceptions.
   *
   * @var array
   */
  protected $dontFlash = [
    'password',
    'password_confirmation',
  ];

  /**
   * Report or log an exception.
   *
   * @param  \Exception  $exception
   * @return void
   */
  public function report(Exception $exception)
  {
    parent::report($exception);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Exception  $exception
   * @return \Illuminate\Http\Response
   */
  public function render($request, Exception $exception)
  { 

    if($exception instanceof TokenMismatchException) {
      #return redirect()->route('web.index');
    }

    if($this->isHttpException($exception)){

      if(!env('APP_DEBUG')){
        switch ($exception->getStatusCode()){
          // not found
          case 404:
          return redirect()->route('web.index');
          break;

          // internal error
          case 500:
          return redirect()->route('web.index');
          break;
        }    
      }else{
        return parent::render($request, $exception);    
      }
        
    } else {
      return parent::render($request, $exception);
    }
  }


  static function error($code, $typeCode, $msg='', $returnJson=false){

    switch ($typeCode) {
      case 23000:
        if($returnJson) return [ 'code'=>$code, 'msg'=>($msg!='') ? $msg : __('error.integrity_constraint') ];
        #abort($code, ($msg!='') ? $msg : __('error.integrity_constraint') );
        abort($code, __('error.integrity_constraint') );
        break;
      case 401:
        if($returnJson) return [ 'code'=>$code, 'msg'=>($msg!='') ? $msg : __('error.unauthorized').' ::: '.__('error.not_permissions') ];
        abort($code, ($msg!='') ? $msg : __('error.unauthorized').' ::: '.__('error.not_permissions') );
        break;
      default:
        if($returnJson) return [ 'code'=>$code, 'msg' => $msg ];
        return abort($code, $msg);
    }        
  }

}
