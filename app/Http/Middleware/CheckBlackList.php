<?php

namespace App\Http\Middleware;

use Closure;
use App\BlackListEmail;

class CheckBlackList
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if($request->user()){
            $blackListEmail = BlackListEmail::where('email', '=', $request->user()->email)->get();
            if($blackListEmail->count() > 0){
                
                if($request->user()->type_user=='backend'){    
                    return redirect()->route('admin.index')->with('error', 'You are in the blacklist, please contact the system administrator.');
                }else{
                    //return redirect()->route('web.index')->with('error', 'You are in the blacklist, please contact the system administrator.');
                }
            };
        }
            

        return $next($request);
    }
}
