<?php
namespace App\Repositorries;

use App\Models\Members;

class MembersRepository 
{
    public function all(){
        $members = Members::all();
        return $members;
    }

    public function saveMember($request){
        $user_id = auth()->user()->id;
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
       return $member;
    }
}