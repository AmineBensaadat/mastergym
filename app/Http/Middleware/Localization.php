<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       

        if (Auth::check()) {
            App::setLocale(Auth::user()->language);

             /* Set new lang with the use of session */
            if (session()->has('lang')) {
                App::setLocale(session()->get('lang'));
            }
            else{
                // get lang of the user connexted
                App::setLocale("ar");
            }
        }
        return $next($request);
    }
}
