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
    
    public function getAllSPlansByAccount($request){
        $user= auth()->user();
        $query = $request['query'];
        $plans = DB::table('plans')  
            ->select('plans.*')
            ->where('plans.account_id', $user->account_id)
            ->where('plans.plan_name','LIKE','%'.$query.'%')
            ->paginate(10); 
        return $plans;
    }

    public function getPlansBySrvice($serviceId) {
        
        $plans = DB::table('plans_services')
                ->join('plans', 'plans_services.plan_id', '=', 'plans.id') 
                ->select('*') 
                ->where('plans_services.service_id', $serviceId)
                ->get();
        return $plans;
    }
    
 
}