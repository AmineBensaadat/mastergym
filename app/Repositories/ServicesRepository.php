<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Members;
use Illuminate\Support\Facades\DB;

class ServicesRepository 
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

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
            ->select('services.*')
            ->where('services.created_by', $user->id)
            ->where('services.account_id', $user->account_id)
            ->where('services.name','LIKE','%'.$query.'%')
            ->orWhere('description', 'like', '%'. $query .'%')
            ->paginate(10); 
        return $services;
    }

    public function renderAllServices(){
        $user= auth()->user();
        $services = DB::table('services')
            ->join('users', 'services.created_by', '=', 'users.id')  
            ->select('services.*')
            ->where('users.account_id', $user->account_id)
            ->get(); 
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

    public function saveService($request){

    }
}