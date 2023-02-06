<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Members;
use Illuminate\Support\Facades\DB;

class MembersRepository 
{
    public function all(){
        $members = DB::table('members')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->select('files.name as img_name','members.*')
            ->get();
        return $members;
    }

    public function getAllMembersByFilters($request){
        $user = auth()->user();
        $data = array();
        $column = array('firstname', 'lastname', 'address', 'email', 'phone', 'DOB');
        $query = DB::table('members')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'plans.service_id', '=', 'services.id')  
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')
            ->select(
                'files.name as member_img',
                'members.*',
                'gyms.name as gym_name',
                'services.id as service_id',
                'services.name as service_name',
                'plans.id as plan_id',
                'plans.plan_name as plan_name')
                ->where('members.account_id',  '=', $user->account_id);

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
        $query->where('firstname',  'like', '%'.$request['global_filter'].'%');
        $query->orWhere('lastname', 'LIKE', '%'.$request['global_filter'].'%');
        $query->orWhere('members.phone', 'LIKE', '%'.$request['global_filter'].'%');
        $query->orWhere('members.cin', 'LIKE', '%'.$request['global_filter'].'%');
        $query->orWhere('members.city', 'LIKE', '%'.$request['global_filter'].'%');
        $query->orWhere('members.address', 'LIKE', '%'.$request['global_filter'].'%');
        
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

    public function renderMembersByStatus($status){
        $data = array();
        $query = DB::table('members')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->leftJoin('services', 'plans.service_id', '=', 'services.id')  
            ->join('gyms', 'members.gym_id', '=', 'gyms.id')
            ->select(
                'files.name as member_img',
                'members.*',
                'gyms.name as gym_name',
                'services.id as service_id',
                'services.name as service_name',
                'plans.id as plan_id',
                'plans.plan_name as plan_name');
            if($status)
            {
            $query->where('subscriptions.status',  '=', $status);
            }
        $data = $query->get();
        return $data;
    }

    public function countAllMembers(){
        $members = Members::get();
        $membersCount = $members->count();
        return $membersCount;

    }

    public function countAllMembersByGym(){
        $members = Members::where('members.gym_id',  '=', 1)->get();
        $membersCount = $members->count();
        return $membersCount;

    }

    public function saveMember($request){
        $user_id = auth()->user()->id;
        $destinationPath = public_path().'/assets/images/members/' ;
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
            'gender' => $request['gym'],
            'health_issues' =>  $request['health_issues'],
            'cin' => $request['cin'],
            'created_by' =>  $user_id,
            'updated_by' =>  $user_id,
            'source' =>  $request['source'],
            'account_id' => auth()->user()->account_id
        ]);

         // save gym profile image
         $file = $request->file('profile_image');
         if($file = $request->hasFile('profile_image')) {
 
             // file data 
             $file = $request->file('profile_image') ;
             $fileName = time().rand(100,999).preg_replace('/\s+/', '', $file->getClientOriginalName());
             $extension = $request->file('profile_image')->extension();
 
             // save gym image in file table
             $files_table= new Files();
             $files_table->name = $fileName;
             $files_table->entity_name = 'member';
             $files_table->ext = $extension;
             $files_table->type = 'profile';
             $files_table->entitiy_id = $member->id;   
             $files_table->save();
 
             // move file in dericory
             $file->move($destinationPath,$fileName);
         }
       return $member;
    }

    public function updateMember($request){
        $user_id= auth()->user()->id;
        $destinationPath = public_path().'/assets/images/members/' ;
        Members::where('id', $request['member_id'])
        ->update([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'updated_by' =>  $user_id,
        ]);

         // save gym profile image
         $file = $request->file('profile_image');
         if($file = $request->hasFile('profile_image')) {
            $file_exist = $this->checkIfexistFile($request['member_id'], 'profile');
            // file data 
            $extension = $request->file('profile_image')->extension();
            $file = $request->file('profile_image') ;
            $fileName = "profile_image_".$request['member_id'].'.'.$extension;
           

            if(count($file_exist) == 0){ // insert
                // insert gym image in file table
                $files_table= new Files();
                $files_table->name = $fileName;
                $files_table->entity_name = 'member';
                $files_table->ext = $extension;
                $files_table->type = 'profile';
                $files_table->entitiy_id = $request['member_id'];   
                $files_table->save();

            }
 
             // move file in dericory
             $file->move($destinationPath,$fileName);
         }
    }

    public function checkIfexistFile($entitiy_id, $type){
        $query = DB::table('files');
        $query->where('entitiy_id',  '=', $entitiy_id);
        $query->where('type',  '=', $type);
        return $query->get();    
    }
}

