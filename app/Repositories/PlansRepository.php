<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Members;
use Illuminate\Support\Facades\DB;

class PlansRepository 
{
    public function getMemberPlan($member_id){
        $plans = DB::table('plans')
        ->join('subscriptions', 'plans.id', '=', 'subscriptions.plan_id')
        ->leftJoin('files', 'plans.id', '=', 'files.entitiy_id')
        ->select('plans.*', 'files.name as plan_img')
        ->where('subscriptions.member_id', $member_id)
        ->get()->first(); 
        return $plans;
    }  
    
 
}