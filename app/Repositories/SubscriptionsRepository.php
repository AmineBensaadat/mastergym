<?php
namespace App\Repositories;

use App\Models\Subscriptions;
use Illuminate\Support\Facades\DB;

class SubscriptionsRepository 
{

    public function addSubscription($request, $memberId){
        dd($request['service'], $memberId);
        $subscription = Subscriptions::create([
            'member_id' => $memberId,
            //'invoice_id' => $request['lastname'],
            //'plan_id' => $request['dob'],
            'email' => $request['email'],
            'address' => $request['address'],
            'status' => $request['status'],
            'contact' => $request['phone'],
            'emergency_contact' => $request['emergency_cont'],
            'gender' => $request['gender'],
            'health_issues' =>  $request['health_issues'],
            'cin' => $request['cin'],
            'created_by' =>  $user_id,
            'updated_by' =>  $user_id,
            'source' =>  $request['source'],
        ]);
       return $subscription;
    }
   
}