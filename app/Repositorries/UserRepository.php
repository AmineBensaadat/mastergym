<?php
namespace App\Repositorries;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserRepository 
{
    public function all(){
        $members = DB::table('members')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->get();
        return $members;
    }

    
    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateUserLang($request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user) {
            switch($request->lang) {
                case('English'):
                    $user->lang = 'en';
                    $user->save();
                    $this->lang('en');
                    break;
     
                case('French'):
                    $user->lang = 'fr';
                    $user->save();
                    $this->lang('fr');
                    break;
                case('Arabic'):
                    $user->lang = 'ar';
                    $user->save();
                    $this->lang('ar');
                    break;
     
            }
        }
       
        return redirect()->route('setting');
    }

    public function getCurrentUser(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return $user;
    }
}