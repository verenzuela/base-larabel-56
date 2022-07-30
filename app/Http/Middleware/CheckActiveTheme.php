<?php

namespace App\Http\Middleware;

use Closure;
use App\Theme;

class CheckActiveTheme
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {

    $activeTheme = Theme::where('status', '=', 1)->first();
    if( $activeTheme ){
      session([
        'theme' => $activeTheme->name,
        'themePrincipalColor' => ($activeTheme->custom_principal_color) ? $activeTheme->custom_principal_color : $activeTheme->principal_color,
        'themePagination' => ($activeTheme->custom_pagination) ? $activeTheme->pagination : false,
        'enableCart' => ($activeTheme->enable_shopping_cart) ? $activeTheme->enable_shopping_cart : false,
        'enableQuestions' => ($activeTheme->enable_questions_produtcs) ? $activeTheme->enable_questions_produtcs : false,
      ]);        
    }else{
      session([
        'theme' => 'default',
        'themePrincipalColor' => false,
      ]);
    }

    return $next($request);

  }

}
