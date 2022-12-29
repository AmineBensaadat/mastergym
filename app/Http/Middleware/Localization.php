<?php

namespace App\Http\Middleware;

use App\Repositorries\UserRepository;
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
            //App::setLocale(Auth::user()->lang);

             /* Set new lang with the use of session */
            if (session()->has('lang')) {
                App::setLocale(session()->get('lang'));
            }
            else{
                // get lang of the user connected
                $curtentUser = $this->userRepository->getCurrentUser();
                if($curtentUser->lang){
                    App::setLocale($curtentUser->lang);
                    Session::put('lang',$curtentUser->lang);
                    Session::save();
                }
                
            }
        }
        return $next($request);
    }
}
