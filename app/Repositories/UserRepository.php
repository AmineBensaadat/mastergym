<?php
namespace App\Repositories;

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

    public function countMaxAccountId(){
        $result = DB::table('users')->max('account_id');
        if (is_null($result)) {
            $result = 1;
        }
        return $result;
    }


    public function getAccountId(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return $user->account_id;
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

    public function getAllUsersByFilters($request){
        $user = auth()->user();
        $data = array();
        $column = array('name', 'email');
        $query = DB::table('users')
            ->select('users.*')
            ->where('users.account_id',  '=', $user->account_id)
            ->where('users.id',  '!=', $user->id);
        

        if(isset($request['filter_name']) && $request['filter_name'] != '')
        {
        $query->where('name',  'like', '%'.$request['filter_name'].'%');
        }

        if(isset($request['filter_email']) && $request['filter_email'] != '')
        {
        $query->where('users.email',  'like', '%'.$request['filter_email'].'%');
        }

        if(isset($request['global_filter']) && $request['global_filter'] != '')
        {
            $query->where(function($q) use ($request) {
                $q->orWhere('name',  'like', '%'.$request['global_filter'].'%');
                $q->orWhere('email', 'LIKE', '%'.$request['global_filter'].'%');
            });
        
        
        }
        if(isset($request['order']))
        {
            $query->orderBy($column[$request['order']['0']['column']], $request['order']['0']['dir']);
        }
        else
        {
            $query->orderBy($column[0], "DESC");
        }

        

        $data[ "result"]  = $query->get();
        if($_POST["length"] != -1)
        {
            $query->offset($request['start'] )->limit($request['length']);
        }
                
        $data ["all_result"] = $query->get();
        return $data;
    }

    public function countAllUsers($request){
        $data = array();
        $user = auth()->user();
        $query = DB::table('users')
            ->select('users.*')
            ->where('users.account_id',  '=', $user->account_id)
            ->where('users.id',  '!=', $user->id);
           
            
        $data = $query->get();
        return $data->count();

    }
}