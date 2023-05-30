<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Members;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class MembersRepository 
{
    private $filesRepository;
    public function __construct(FilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
    }

    public function all(){
        $members = DB::table('members')
            ->get();
        return $members;
    }

    public function getAllMembersByFilters($request){
        $user = auth()->user();
        $data = array();
        $column = array('firstname', 'lastname', 'address', 'email', 'phone', 'DOB');
        $query = DB::table('members')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'members.service_id', '=', 'services.id')  
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')->groupBy('members.id')
            ->select(
                'members.*',
                'gyms.name as gym_name',
                'gyms.id as gym_id',
                'members.service_id',
                'services.name as service_name',
                'plans.id as plan_id',
                'plans.plan_name as plan_name')
                ->where('members.account_id',  '=', $user->account_id);
        
        if($user->default_gym_id){
            $query->where('members.gym_id',  '=', $user->default_gym_id);
        }

        if(isset($request['filter_firstname']) && $request['filter_firstname'] != '')
        {
        $query->where('firstname',  'like', '%'.$request['filter_firstname'].'%');
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

    public function getMonthlyJoiningsMembers($request){
        $user = auth()->user();
        $data = array();
        $column = array('firstname', 'lastname', 'address', 'email', 'phone', 'DOB');
        $query = DB::table('members')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'members.service_id', '=', 'services.id')  
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')->groupBy('members.id')
            ->select(
                'members.*',
                'gyms.name as gym_name',
                'gyms.id as gym_id',
                'services.id as service_id',
                'services.name as service_name',
                'plans.id as plan_id',
                'plans.plan_name as plan_name')
                ->where('members.account_id',  '=', $user->account_id);
        
                $query->whereMonth('members.created_at',  '=',  now()->format('m') );
        $query->whereYear('members.created_at',  '=',  now()->format('Y'));
        
        if($user->default_gym_id){
            $query->where('members.gym_id',  '=', $user->default_gym_id);
        }

        if(isset($request['filter_firstname']) && $request['filter_firstname'] != '')
        {
        $query->where('firstname',  'like', '%'.$request['filter_firstname'].'%');
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

    public function countMonthlyJoiningsMembers($request){
        $data = array();
        $user = auth()->user();
        $query = DB::table('members')
            ->select('members.*')->groupBy('members.id');

            $query->where('members.account_id',  '=', $user->account_id);
            if($user->default_gym_id){
                $query->where('members.gym_id',  '=', $user->default_gym_id);
            }

            $query->whereMonth('members.created_at',  '=',  now()->format('m') );
            $query->whereYear('members.created_at',  '=',  now()->format('Y'));
            
        $data = $query->get();
        return $data->count();

    }

    public function getPendingPaimentMembers($request){
        $user = auth()->user();
        $data = array();
        $column = array('firstname', 'lastname', 'address', 'email', 'phone', 'DOB');
        $query = DB::table('members')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'members.service_id', '=', 'services.id')  
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')
            ->join('invoices', 'members.id', '=', 'invoices.member_id')
            ->select(
                'members.*',
                'gyms.name as gym_name',
                'gyms.id as gym_id',
                'services.id as service_id',
                'services.name as service_name',
                'plans.id as plan_id',
                'plans.plan_name as plan_name',
                'invoices.amount_pending')
                ->where('members.account_id',  '=', $user->account_id);
                $query->where('invoices.amount_pending',  '>', 0);
        
        if($user->default_gym_id){
            $query->where('members.gym_id',  '=', $user->default_gym_id);
        }

        if(isset($request['filter_firstname']) && $request['filter_firstname'] != '')
        {
        $query->where('firstname',  'like', '%'.$request['filter_firstname'].'%');
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

    public function getPendingPaimentByMember($request){
        $user = auth()->user();
        $data = array();
        $column = array('firstname', 'lastname', 'address', 'email', 'phone', 'DOB');
        $query = DB::table('members')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'members.service_id', '=', 'services.id')  
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')
            ->join('invoices', 'members.id', '=', 'invoices.member_id')
            ->select(
                'members.*',
                'gyms.name as gym_name',
                'gyms.id as gym_id',
                'services.id as service_id',
                'services.name as service_name',
                'plans.id as plan_id',
                'plans.plan_name as plan_name',
                'invoices.amount_pending',
                'invoices.id as invoice_id'
                )
                ->where('members.account_id',  '=', $user->account_id);
                $query->where('invoices.amount_pending',  '>', 0);
        
        if($user->default_gym_id){
            $query->where('members.gym_id',  '=', $user->default_gym_id);
        }

        if(isset($request['filter_firstname']) && $request['filter_firstname'] != '')
        {
        $query->where('firstname',  'like', '%'.$request['filter_firstname'].'%');
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

        if(isset($request['member_id']) && $request['member_id'] != '')
        {
        $query->where('members.id',  '=', $request['member_id']);
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

    public function getExpireMembers($request){
        $user = auth()->user();
        $data = array();
        $column = array('firstname', 'lastname', 'address', 'email', 'phone', 'DOB');
        $query = DB::table('members')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'members.service_id', '=', 'services.id')  
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')
            ->join('invoices', 'members.id', '=', 'invoices.member_id')->groupBy('members.id')
            ->select(
                'members.*',
                'subscriptions.end_date as expired_at',
                'gyms.name as gym_name',
                'services.id as service_id',
                'services.name as service_name',
                'plans.id as plan_id',
                'plans.plan_name as plan_name')
                ->where('members.account_id',  '=', $user->account_id);
                $query->where('subscriptions.end_date',  '<', date('Y-m-d'));
        
        if($user->default_gym_id){
            $query->where('members.gym_id',  '=', $user->default_gym_id);
        }
        if(isset($request['filter_firstname']) && $request['filter_firstname'] != '')
        {
        $query->where('firstname',  'like', '%'.$request['filter_firstname'].'%');
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

    public function countMembersByStatus($status, $request){
        $data = array();
        $user = auth()->user();
        $query = DB::table('members')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'members.service_id', '=', 'services.id')  
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
            
            if(isset($request['member_id']) && $request['member_id'] != '')
            {
                $query->where('members.id',  '=', $request['member_id']);
            }
                
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

    public function countAllMembers($request){
        $data = array();
        $user = auth()->user();
        $query = DB::table('members')
            ->select('members.*');

            $query->where('members.account_id',  '=', $user->account_id);
            if($user->default_gym_id){
                $query->where('members.gym_id',  '=', $user->default_gym_id);
            }
            
        $data = $query->get();
        return $data->count();

    }

    public function countAllMembersByGym($gym_id){
        $user = auth()->user();
        $members = Members::where([
                ['members.gym_id',  '=', $gym_id],
                ['members.account_id',  '=', $user->account_id]
            ])->get();
        $membersCount = $members->count();
        return $membersCount;
    }

    public function saveMember($request){
     
        $user = auth()->user();
        $destinationPath = public_path().'/assets/images/members/'.$user->account_id.'/' ;
        // save in member table
        $member = Members::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'DOB' => $request['dob'],
            'email' => $request['email'],
            'city' => $request['city'],
            'address' => $request['address'],
            'status' => $request['status'],
            'phone' => $request['phone'],
            'emergency_contact' => $request['emergency_contact'],
            'gender' => $request['gender'],
            'gym_id' => $request['gym'],
            'health_issues' =>  $request['health_issues'],
            'cin' => $request['cin'],
            'created_by' =>  $user->id,
            'created_at' =>  $request['created_at'],
            'updated_by' =>  $user->id,
            'source' =>  $request['source'],
            'account_id' => $user->account_id
        ]);

         // save gym profile image
         $file = $request->file('profile_image');
 
         if($file = $request->hasFile('profile_image')) {
                 // save the file
                try {
                    $extension = $request->file('profile_image')->extension();
                    $fileName = "member_image_".$request['firstname']."_".$request['lastname']."_".$member->id.'_'.time().'.'.$extension;
                    $this->filesRepository->saveFile($request, $member->id, $fileName ,$destinationPath, 'members', 'profile', 'profile_image');
                } catch (Throwable $e) {
                    report($e);
            
                    return $e;
                }
 
         }
       return $member;
    }

    public function updateMember($request){ 
        $user = auth()->user();
        $destinationPath = public_path().'/assets/images/members/'.$user->account_id.'/' ;
        Members::where('id', $request['member_id'])
        ->update([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'DOB' => $request['dob'],
            'email' => $request['email'],
            'city' => $request['city'],
            'address' => $request['address'],
            'status' => $request['status'],
            'phone' => $request['phone'],
            'emergency_contact' => $request['emergency_contact'],
            'gender' => $request['gender'],
            'gym_id' => $request['gym'],
            'service_id' => $request['service'],
            'created_at' =>  $request['created_at'],
            'health_issues' =>  $request['health_issues'],
            'cin' => $request['cin'],
            'updated_by' =>  $user->id,
            'source' =>  $request['source']
        ]);

         // save gym profile image
         $file = $request->file('profile_image');
 
         if($file = $request->hasFile('profile_image')) {
                 // save the file
                try {
                    $extension = $request->file('profile_image')->extension();
                    $fileName = "member_image_".$request['firstname']."_".$request['lastname']."_".$request['member_id'].'_'.time().'.'.$extension;
                    $this->filesRepository->saveFile($request, $request['member_id'], $fileName ,$destinationPath, 'members', 'profile', 'profile_image');
                } catch (Throwable $e) {
                    report($e);
            
                    return $e;
                }
 
         }
    }

    public function deleteMember($member_id){
        $deleted = Members::where('id', $member_id)->delete();
        return $deleted;
    }

    public function checkifMemberIxistInGym($row){
        $user = auth()->user();
        $members = Members::where([
                ['members.firstname',  '=', $row['firstname']],
                ['members.lastname',  '=', $row['lastname']]
            ])->get();
        $membersCount = $members->count();
        return $membersCount;
    }

}

