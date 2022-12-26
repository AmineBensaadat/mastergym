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
        $member = Members::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'DOB' => $request['dob'],
            'email' => $request['email'],
            'address' => $request['address'],
            'status' => 1,
            'contact' => $request['phone'],
            'emergency_contact' => $request['emergency_cont'],
            'gender' => "men",
            'health_issues' =>  "men",
            //'cin' => $request['cin'],
            'created_by' =>  1,
            'updated_by' =>  1,
            'source' =>  "men",
        ]);
       return $member;
    }
}