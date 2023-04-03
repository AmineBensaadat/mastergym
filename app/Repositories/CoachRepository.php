<?php
namespace App\Repositories;

use App\Models\Coach;
use App\Models\Files;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class CoachRepository 
{
    private $filesRepository;
    public function __construct(FilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
    }

    public function saveCoach($request){
     
        $user = auth()->user();
        $destinationPath = public_path().'/assets/images/coachs/'.$user->account_id.'/' ;
        // save in member table
        $coach = Coach::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'DOB' => $request['dob'],
            'email' => $request['email'],
            'city' => $request['city'],
            'address' => $request['address'],
            'status' => $request['status'],
            'phone' => $request['phone'],
            'emergency_contact' => $request['emergency_contact'],
            'gender' => $request['gender'],
            'health_issues' =>  $request['health_issues'],
            'cin' => $request['cin'],
            'created_by' =>  $user->id,
            'account_id' => $user->account_id
        ]);

         // save gym profile image
         $file = $request->file('profile_image');
 
         if($file = $request->hasFile('profile_image')) {
                 // save the file
                try {
                    $extension = $request->file('profile_image')->extension();
                    $fileName = "coach_image_".$request['firstname']."_".$request['lastname']."_".$coach->id.'_'.time().'.'.$extension;
                    $this->filesRepository->saveFile($request, $coach->id, $fileName ,$destinationPath, 'coach', 'profile', 'profile_image');
                } catch (Throwable $e) {
                    report($e);
            
                    return $e;
                }
 
         }
       return $coach;
    }

    public function getCoach($id){
        $user = auth()->user();
        $coach = DB::table('coach')
            ->select('coach.*')
            ->where('coach.id', $id)
            ->where('coach.account_id',  '=', $user->account_id)->first();
        
        return $coach;
    }

    public function updateCoach($request){ 
        $user = auth()->user();
        $destinationPath = public_path().'/assets/images/members/'.$user->account_id.'/' ;
        Members::where('id', $request['member_id'])
        ->update([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'DOB' => $request['dob'],
            'email' => $request['email'],
            'city' => $request['city'],
            'address' => $request['address'],
            'status' => $request['status'],
            'phone' => $request['phone'],
            'emergency_contact' => $request['emergency_contact'],
            'gender' => $request['gender'],
            'gym_id' => $request['gym'],
            'service_id' => $request['service'],
            'created_at' =>  $request['created_at'],
            'health_issues' =>  $request['health_issues'],
            'cin' => $request['cin'],
            'updated_by' =>  $user->id,
            'source' =>  $request['source']
        ]);

         // save gym profile image
         $file = $request->file('profile_image');
 
         if($file = $request->hasFile('profile_image')) {
                 // save the file
                try {
                    $extension = $request->file('profile_image')->extension();
                    $fileName = "member_image_".$request['firstname']."_".$request['lastname']."_".$request['member_id'].'_'.time().'.'.$extension;
                    $this->filesRepository->saveFile($request, $request['member_id'], $fileName ,$destinationPath, 'members', 'profile', 'profile_image');
                } catch (Throwable $e) {
                    report($e);
            
                    return $e;
                }
 
         }
    }

   
}

