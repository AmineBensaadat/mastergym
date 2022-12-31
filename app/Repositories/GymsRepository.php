<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Members;
use Illuminate\Support\Facades\DB;

class GymsRepository 
{
    public function getAllGymByCretedById(){
        $user = auth()->user();
        $gyms = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->leftJoin('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('files.name as img_name','gyms.*')
            ->where('gyms.created_by', $user->id)
            ->where('users.account_id', $user->account_id)
            ->get();
        return $gyms;
    }

    public function renderAllGymByCretedById(){
        $user = auth()->user();
        $gyms = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->select('gyms.*')
            ->where('gyms.created_by', $user->id)
            ->where('users.account_id', $user->account_id)
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
}