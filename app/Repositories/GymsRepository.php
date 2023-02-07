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
            //->where('gyms.created_by', $user->id)
            ->where('gyms.account_id', $user->account_id)
            ->get();
        return $gyms;
    }

    public function renderAllGymByCretedById(){
        $user = auth()->user();
        $gyms = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->select('gyms.*')
            ->where('gyms.created_by', $user->id)
            ->where('gyms.account_id', $user->account_id)
            ->get();
        return $gyms;
    }
}