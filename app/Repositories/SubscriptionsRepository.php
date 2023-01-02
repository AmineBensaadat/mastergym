<?php
namespace App\Repositories;

use App\Models\Subscriptions;
use Illuminate\Support\Facades\DB;

class SubscriptionsRepository 
{

    public function addSubscription($request, $memberId){
        $subscription = Subscriptions::create([
            'member_id' => $memberId,
            'invoice_id' => 1,
            'plan_id' => $request['plans'],
            'start_date' => date('y/m/d'),
            'end_date' => date('y/m/d'),
            'status' => 1,
            'is_renewal' => 0,
            'created_by' => 1,
            'updated_by' => 1
            // 'contact' => $request['phone'],
            // 'emergency_contact' => $request['emergency_cont'],
            // 'gender' => $request['gender'],
            // 'health_issues' =>  $request['health_issues'],
            // 'cin' => $request['cin'],
            // 'created_by' =>  $user_id,
            // 'updated_by' =>  $user_id,
            // 'source' =>  $request['source'],
        ]);
       return $subscription;
    }
   
}