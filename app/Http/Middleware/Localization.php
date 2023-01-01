<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Localization
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /* Set new lang with the use of session */
        if (session()->has('lang')) {
            App::setLocale(session()->get('lang'));
        }

        if (Auth::check()) {
            $curtentUser = $this->userRepository->getCurrentUser();

             /* Set new lang with the use of session */
            if (session()->has('lang')) {
                App::setLocale(session()->get('lang'));
            }
            elseif($curtentUser->lang){
            // get lang of the user connected
                App::setLocale($curtentUser->lang);
                Session::put('lang',$curtentUser->lang);
                Session::save();
            }else{
                App::setLocale('fr');
                Session::put('lang','fr');
                Session::save();
            }
        }
        return $next($request);
    }
}
