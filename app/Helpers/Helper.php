<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Members;
use App\Repositories\FilesRepository;
use App\Repositories\ServicesRepository;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Helper
{
    private $filesRepository;
    public function __construct(
        FilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
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
            ->select('files.name as file_name')
            ->where('files.entitiy_id', $entitiy_id)
            ->where('files.entity_name', $entity_name)
            ->where('files.type', $entity_type)
            ->get();
            if(count($result) > 0){
                return $result[0]->file_name;
            }
            return "default.png";
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
        ->leftjoin('users', 'gyms.id', '=', 'users.default_gym_id')
        ->select('gyms.*', 'users.default_gym_id' )
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


}

