<?php
namespace App\Repositories;

use App\Models\Subscriptions;
use Illuminate\Support\Facades\DB;

class SubscriptionsRepository 
{

    public function addSubscription($request, $memberId){
        $user_id= auth()->user()->id;
        $subscription = Subscriptions::create([
            'member_id' => $memberId,
            'invoice_id' => 1,
            'plan_id' => $request['plans'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'status' => 1,
            'is_renewal' => 0,
            'created_by' =>  $user_id,
            'updated_by' =>  $user_id,
        ]);
       return $subscription;
    }

    public function getAllSucription(){
        $user= auth()->user();
        $subscriptions = DB::table('subscriptions')
            ->join('users', 'subscriptions.created_by', '=', 'users.id') 
            ->join('members', 'subscriptions.member_id', '=', 'members.id')   
            ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->join('services', 'plans.service_id', '=', 'services.id')      
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->select(
                'subscriptions.*',
                'members.id as member_id',
                'members.firstname', 
                'members.lastname', 
                'services.id as service_id', 
                'files.name as member_img', 
                'plan_name', 
                'services.name as service_name')
            ->where('users.account_id', $user->account_id)
            // ->where('services.name','LIKE','%'.$query.'%')
            // ->orWhere('description', 'like', '%'. $query .'%')
            ->paginate(10); 
        return $subscriptions;
    }
   
}