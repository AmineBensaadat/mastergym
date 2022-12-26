<?php
namespace App\Repositorries;

use App\Models\Members;

class MembersRepository 
{
    public function all(){
        $members = Members::all();
        return $members;
    }
}