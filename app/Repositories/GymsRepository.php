<?php
namespace App\Repositories;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Models\User;
use App\Repositories\FilesRepository;
use Illuminate\Support\Facades\DB;

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
        $destinationPath = public_path().'/assets/images/gyms/' ;
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
          
            $fileExist = $this->filesRepository->checkFileByEntityId($request['gym_id'], 'gyms', 'profile');
            $file = $request->file('profile_image') ;
            $extension = $request->file('profile_image')->extension();
            $fileName = "profile_image_gyms_".$request['gym_id'].'.'.$extension;
            

            if(count($fileExist) > 0){ // update

                $old_files_table = Files::findOrFail($fileExist[0]->id);

                // update service image in file table
                $old_files_table->name = $fileName;
                $old_files_table->ext = $extension;
                $old_files_table->update();

            }else{ // insert

                    // insert gym image in file table
                    $files_table= new Files();
                    $files_table->name = $fileName;
                    $files_table->entity_name = 'gyms';
                    $files_table->ext = $extension;
                    $files_table->type = 'profile';
                    $files_table->entitiy_id = $request['gym_id'];   
                    $files_table->save();
                }

            // move file in dericory
            $file->move($destinationPath,$fileName);
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