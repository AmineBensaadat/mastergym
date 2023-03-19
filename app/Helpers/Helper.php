<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Invoices;
use App\Models\Members;
use App\Repositories\FilesRepository;
use App\Repositories\MembersRepository;
use App\Repositories\ServicesRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Helper
{
    private $filesRepository;
    private $membersRepository;
    
    public function __construct(
        FilesRepository $filesRepository, MembersRepository $membersRepository)
    {
        $this->filesRepository = $filesRepository;
        $this->membersRepository = $membersRepository;
    } 
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function dateDiff($date_start, $date_end)
    {
        return round(abs(strtotime($date_start) - strtotime($date_end))/86400); 
    }

    public static function getImageByEntityId($entitiy_id, $entity_name, $entity_type){
        $result = DB::table('files')
            ->select('files.name as file_name', 'account_id')
            ->where('files.entitiy_id', $entitiy_id)
            ->where('files.entity_name', $entity_name)
            ->where('files.type', $entity_type)
            ->get();
            if(count($result) > 0){
                return "/assets/images/".$entity_name."/".$result[0]->account_id."/".$result[0]->file_name;
            }
            return "/assets/images/".$entity_name."/default.png";
    }

    public static function countAllMembersByService($service_id){
        $data = array();
        $user = auth()->user();
        $query = DB::table('members')->select('members.*')
        ->join('subscriptions', 'members.id', '=', 'subscriptions.member_id');
        $query->where('members.account_id',  '=', $user->account_id);
        $query->where('subscriptions.service_id',  '=', $service_id);
            $data = $query->get();
            return $data->count();
    }

    public static function countAllMembersByPlan($plan_id){
        $data = array();
        $user = auth()->user();
        $query = DB::table('members')->select('members.*')
        ->join('subscriptions', 'members.id', '=', 'subscriptions.member_id');
        $query->where('members.account_id',  '=', $user->account_id);
        $query->where('subscriptions.plan_id',  '=', $plan_id);
        $data = $query->get();
        return $data->count();
    }

    public static function countSubscriptionsPendingPayment($member_id){
        $query = DB::table('invoices')->select('invoices.*');
        $query->where('invoices.member_id',  '=', $member_id);
        $query->where('invoices.amount_pending',  '>', 0);

        return ($query->get())->count();
    }

    public static function countTotalPendingPayment($member_id){
        $amount = Invoices::where('member_id', $member_id)->sum('amount_pending');

        return $amount;
    }
    

    public static function countAllPlansByService($service_id){

      $data = array();
      $user = auth()->user();
      $query = DB::table('plans')->select('plans.*');
      $query->where('plans.service_id',  '=', $service_id);
      $query->where('plans.account_id',  '=', $user->account_id);
          $data = $query->get();
          return $data->count();
  }

  public static function countAllMembersByGym($gym_id){
    $user = auth()->user();
    $members = Members::where([
            ['members.gym_id',  '=', $gym_id],
            ['members.account_id',  '=', $user->account_id]
        ])->get();
    $membersCount = $members->count();
    return $membersCount;
}

public static function getAllGymByAccountId(){
    $user = auth()->user();
    $gyms = DB::table('gyms')
        ->select('gyms.*')
        ->where('gyms.account_id', $user->account_id)
        ->get();
    return $gyms;
}

public static function getGymServiceByServiceId($service_id){
    $gym = DB::table('services_gyms')
        ->join('gyms', 'gyms.id', '=', 'services_gyms.gym_id')
        ->select('gyms.*')
        ->where('services_gyms.service_id', $service_id)
        ->get()->first();
    return $gym;
}

public static function countMembersByStatus($status){
    $data = array();
    $user = auth()->user();
    $query = DB::table('members')
        ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
        ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
        ->leftJoin('services', 'plans.service_id', '=', 'services.id')  
        ->leftJoin('invoices', 'members.id', '=', 'invoices.member_id')
        ->join('gyms', 'members.gym_id', '=', 'gyms.id')
        ->select(
            'members.*',
            'subscriptions.end_date as expired_at',
            'gyms.name as gym_name',
            'services.id as service_id',
            'services.name as service_name',
            'plans.id as plan_id',
            'plans.plan_name as plan_name');
        
            
        switch ($status) {
                case 'all_members':
                    $query->groupBy('members.id');
                    break;
                case 'expired':
                    $query->where('subscriptions.end_date',  '<', date('Y-m-d'));
                    $query->groupBy('members.id');
                    break;
                case 'pending_paiment':
                    $query->where('invoices.amount_pending',  '>', 0);
                    break;
                case 'pending_paiment_of_user':
                    $query->where('invoices.amount_pending',  '>', 0);
                    break;
                case 'monthlyJoined':
                    $query->whereMonth('members.created_at',  '=',  now()->format('m') );
                    $query->whereYear('members.created_at',  '=',  now()->format('Y'));
                    $query->groupBy('members.id');
                    break;
            }
        $query->where('members.account_id',  '=', $user->account_id);
        if($user->default_gym_id){
            $query->where('members.gym_id',  '=', $user->default_gym_id);
        }
        
    $data = $query->get();
    return $data->count();
}

}

