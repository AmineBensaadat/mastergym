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
                'services.name as service_name');
        if(isset($request['filter_firstname']) && $request['filter_firstname'] != '')
        {
        $query->where('firstname',  'like', '%'.$request['filter_firstname'].'%');
        }

        if(isset($request['global_filter']) && $request['global_filter'] != '')
        {
        $query->where('firstname',  'like', '%'.$request['global_filter'].'%');
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

    public function countAllMembers(){
        $members = Members::get();
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
}