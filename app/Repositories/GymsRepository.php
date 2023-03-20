<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Models\User;
use App\Repositories\FilesRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class GymsRepository 
{
    private $filesRepository;

    public function __construct(FilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
    }

    public function getAllGymByCretedById(){
        $user = auth()->user();
        $gyms = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->select('gyms.*')
            //->where('gyms.created_by', $user->id)
            ->where('gyms.account_id', $user->account_id)
            ->get();
        return $gyms;
    }

    public function renderAllGymByCretedById(){
        $user = auth()->user();
        $gyms = DB::table('gyms')
            //->join('users', 'gyms.created_by', '=', 'users.id')
            ->select('gyms.*')
            //->where('gyms.created_by', $user->id)
            ->where('gyms.account_id', $user->account_id)
            ->get();
        return $gyms;
    }

    public function updateGym($request){
        $user = auth()->user();
        $destinationPath = public_path().'/assets/images/gyms/'.$user->account_id.'/' ;
        Gyms::where('id', $request['gym_id'])
        ->update([
            'name' => $request['gym_name'],
            'phone' => $request['gym_phone'],
            'address' =>  $request['gym_address'],
            'desc' => $request['gym_desc'],
            'is_main' => $request['is_main']
        ]);

         // save gym profile image
         $file = $request->file('profile_image');
        
         if($file = $request->hasFile('profile_image')) {
          
            try {
                $extension = $request->file('profile_image')->extension();
                $fileName = "gym_image_".$request['gym_name']."_".$request['gym_id'].'_'.time().'.'.$extension;
                $this->filesRepository->saveFile($request, $request['gym_id'], $fileName ,$destinationPath, 'gyms', 'profile', 'profile_image');
            } catch (Throwable $e) {
                report($e);
        
                return $e;
            }
         }
    }

    public function checkIfexistFile($entitiy_id, $type, $entity_name){
        $query = DB::table('files');
        $query->where('entitiy_id',  '=', $entitiy_id);
        $query->where('type',  '=', $type);
        $query->where('entity_name',  '=', $entity_name);
        return $query->get();    
    }

    public function updateDefaultGym_id($gym_id, $user_id){
        User::where('id', $user_id)
        ->update(
            [
                'default_gym_id' => $gym_id
            ]
    );

    }
}