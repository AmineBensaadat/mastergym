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
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'status' => 1,
            'is_renewal' => 0,
            'created_by' => 1,
            'updated_by' => 1
        ]);
       return $subscription;
    }
   
}