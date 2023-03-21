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
            'service_id' => $request['service'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'status' => 1,
            'is_renewal' => 0,
            'created_by' =>  $user_id,
            'updated_by' =>  $user_id,
        ]);
       return $subscription;
    }

    public function updateSubscription($request, $subscription_id, $invoice_id){
        $user_id= auth()->user()->id;
        Subscriptions::where('id', $subscription_id)
        ->update([
            'invoice_id' => $invoice_id,
            'plan_id' => $request['plans'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'status' => $request['status'],
            'is_renewal' => 0,
            'created_by' =>  $user_id,
            'updated_by' =>  $user_id,
        ]);
        
       return $subscription_id;
    }

    public function getAllSucription(){
        $user= auth()->user();
        $subscriptions = DB::table('subscriptions')
            ->join('users', 'subscriptions.created_by', '=', 'users.id') 
            ->join('members', 'subscriptions.member_id', '=', 'members.id')   
            ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->join('services', 'members.service_id', '=', 'services.id')      
            ->select(
                'subscriptions.*',
                'members.id as member_id',
                'members.firstname', 
                'members.lastname', 
                'services.id as service_id', 
                'plan_name', 
                'services.name as service_name')
            ->where('users.account_id', $user->account_id)
            // ->where('services.name','LIKE','%'.$query.'%')
            // ->orWhere('description', 'like', '%'. $query .'%')
            ->paginate(10); 
        return $subscriptions;
    }

    public function getSinglSubscription($member_id){

        $user= auth()->user();
        $subscriptions = DB::table('subscriptions')
            ->join('users', 'subscriptions.created_by', '=', 'users.id') 
            ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->join('services', 'plans.service_id', '=', 'services.id')      
            ->select('subscriptions.*', 'plans.plan_name', 'plans.days', 'plans.amount', 'plans.id as plan_id', 'plans.plan_details', 'plans.amount', 'services.name as service_name' )
            ->where('users.account_id', $user->account_id)
            ->where('subscriptions.member_id', $member_id)
            ->get()->first();
        return $subscriptions;

    }

   
}