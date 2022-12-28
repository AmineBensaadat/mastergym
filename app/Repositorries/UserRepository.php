<?php
namespace App\Repositorries;
use Illuminate\Support\Facades\DB;

class UserRepository 
{
    public function all(){
        $members = DB::table('members')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->get();
        return $members;
    }
}