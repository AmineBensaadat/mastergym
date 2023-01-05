<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Members;
use Illuminate\Support\Facades\DB;

class ServicesRepository 
{

    public function getAllServicesByGym(){
        $user_id = auth()->user()->id;
        $services = DB::table('services')
            ->leftJoin('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('files.name as img_name','gyms.*')
            ->where('gyms.created_by', $user_id)
            ->get();
        return $services;
    }

    public function getAllServices($request){
        $user= auth()->user();
        $query = $request['query'];
        $services = DB::table('services')
            ->join('users', 'services.created_by', '=', 'users.id') 
            ->join('plans', 'services.id', '=', 'plans.service_id')  
            ->leftJoin('files', 'services.id', '=', 'files.entitiy_id')
            ->select('services.*', 'files.name as img_name', 'plans.plan_name', 'plans.id as plan_id')
            ->where('services.created_by', $user->id)
            ->where('users.account_id', $user->account_id)
            ->where('services.name','LIKE','%'.$query.'%')
            ->orWhere('description', 'like', '%'. $query .'%')
            ->paginate(10); 
        return $services;
    } 
    
    public function getServiceProfileImage(){
        $result = DB::table('services')
        ->join('users', 'services.created_by', '=', 'users.id')  
        ->select('services.*')
        ->where('services.created_by', $user->id)
        ->where('users.account_id', $user->account_id)
        ->get(); 
    return $services;  
    }

    public function renderAllGymByCretedById(){
        $user_id = auth()->user()->id;
        $gyms = DB::table('gyms')
            ->leftJoin('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('gyms.id', 'files.name as img_name as gymImg','gyms.name as gymName')
            ->where('gyms.created_by', $user_id)
            ->get();
        return $gyms;
    }

    public function saveMember($request){
        $user_id = auth()->user()->id;
        $destinationPath = public_path().'/assets/images/members/' ;
        $member = Members::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'DOB' => $request['dob'],
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
         // save gym profile image
         $file = $request->file('profile_image');
         if($file = $request->hasFile('profile_image')) {
 
             // file data 
             $file = $request->file('profile_image') ;
             $fileName = time().rand(100,999).preg_replace('/\s+/', '', $file->getClientOriginalName());
             $extension = $request->file('profile_image')->extension();
 
             // save gym image in file table
             $files_table= new Files();
             $files_table->img_name = $fileName;
             $files_table->ext = $extension;
             $files_table->type = 'profile';
             $files_table->entitiy_id = $member->id;   
             $files_table->save();
 
             // move file in dericory
             $file->move($destinationPath,$fileName);
         }
       return $member;
    }
    public function saveService($request){

    }
}