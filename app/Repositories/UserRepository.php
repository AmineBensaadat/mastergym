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
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')
            ->select(
                'users.*',
                'gyms.name as gym_name',
                'gyms.id as gym_id')
                ->where('users.account_id',  '=', $user->account_id);
        

        if(isset($request['name']) && $request['name'] != '')
        {
        $query->where('name',  'like', '%'.$request['name'].'%');
        }

        if(isset($request['filter_lastname']) && $request['filter_lastname'] != '')
        {
        $query->where('members.lastname',  'like', '%'.$request['filter_lastname'].'%');
        }

        if(isset($request['filter_cin']) && $request['filter_cin'] != '')
        {
        $query->where('members.cin',  'like', '%'.$request['filter_cin'].'%');
        }

        if(isset($request['filter_phone']) && $request['filter_phone'] != '')
        {
        $query->where('members.phone',  'like', '%'.$request['filter_phone'].'%');
        }

        if(isset($request['filter_address']) && $request['filter_address'] != '')
        {
        $query->where('members.address',  'like', '%'.$request['filter_address'].'%');
        }

        if(isset($request['filter_city']) && $request['filter_city'] != '')
        {
        $query->where('members.city',  'like', '%'.$request['filter_city'].'%');
        }

        if(isset($request['gymId']) && $request['gymId'] != '')
        {
        $query->where('members.gym_id',  '=', $request['gymId']);
        }
        
        if(isset($request['filter_service']) && $request['filter_service'] != '')
        {
        $query->where('services.id',  '=', $request['filter_service']);
        }

        if(isset($request['filter_plans']) && $request['filter_plans'] != '')
        {
        $query->where('plans.id',  '=', $request['filter_plans']);
        }
        
        if(isset($request['global_filter']) && $request['global_filter'] != '')
        {
            $query->where(function($q) use ($request) {
                $q->orWhere('firstname',  'like', '%'.$request['global_filter'].'%');
                $q->orWhere('lastname', 'LIKE', '%'.$request['global_filter'].'%');
                $q->orWhere('members.phone', 'LIKE', '%'.$request['global_filter'].'%');
                $q->orWhere('members.cin', 'LIKE', '%'.$request['global_filter'].'%');
                $q->orWhere('members.city', 'LIKE', '%'.$request['global_filter'].'%');
                $q->orWhere('members.address', 'LIKE', '%'.$request['global_filter'].'%');
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

    public function countAllMembers($request){
        $data = array();
        $user = auth()->user();
        $query = DB::table('members')
            ->select('members.*');

            $query->where('members.account_id',  '=', $user->account_id);
            if($request->session()->has('selected_gym')){
                $query->where('members.gym_id',  '=', $request->session()->get('selected_gym'));
            }
            if($user->default_gym_id){
                $query->where('members.gym_id',  '=', $user->default_gym_id);
            }
            
        $data = $query->get();
        return $data->count();

    }
}