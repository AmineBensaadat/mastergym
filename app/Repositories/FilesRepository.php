<?php
namespace App\Repositories;

use App\Models\Files;
use Illuminate\Support\Facades\DB;

class FilesRepository 
{

    
   public function getFileByEntityId($entitiy_id, $entity_name, $entity_type){
      $result = DB::table('files')
      ->select('files.name as file_name', 'account_id')
      ->where('files.entitiy_id', $entitiy_id)
      ->where('files.entity_name', $entity_name)
      ->where('files.type', $entity_type)
      ->get();
      if(count($result) > 0){
          return "/assets/images/".$entity_name."/".$result[0]->account_id."/".$result[0]->file_name;
      }
      return "/assets/images/".$entity_name."/default.png";
   }

   public function checkFileByEntityId($entitiy_id, $entity_name, $entity_type){
      $result = DB::table('files')
      ->select('*')
      ->where('files.entitiy_id', $entitiy_id)
      ->where('files.entity_name', $entity_name)
      ->where('files.type', $entity_type)
      ->get();
      return $result;
   }

   public function saveFile($request, $entitiy_id, $fileName ,$destinationPath, $entity_name, $entity_type, $file_input){
         $user = auth()->user();
         $file = $request->file($file_input);
         $extension = $request->file($file_input)->extension();
         $fileExist = $this->checkFileByEntityId($entitiy_id, $entity_name, $entity_type);
      if(count($fileExist) > 0){ // update
         $old_files_table = Files::findOrFail($fileExist[0]->id);
         // update service image in file table
         $old_files_table->name =$fileExist[0]->name;
         $old_files_table->ext = $extension;
         $old_files_table->update();

         $file->move($destinationPath,$fileExist[0]->name);

     }else{ // insert

         // save gym image in file table
         $files_table= new Files();
         $files_table->name = $fileName;
         $files_table->entity_name = $entity_name;
         $files_table->ext = $extension;
         $files_table->account_id = $user->account_id;
         $files_table->type = $entity_type;
         $files_table->entitiy_id = $entitiy_id;   
         $files_table->save();
   
         // move file in dericory
         $file->move($destinationPath,$fileName);
     }
      
   }

   public function updateFile($request, $entitiy_id, $destinationPath){
      $file = $request->file('profile_image');
      $extension = $request->file('profile_image')->extension();
      $fileName = "member_image_".$entitiy_id.'_'.time().'.'.$extension;

      // save gym image in file table
      $files_table= new Files();
      $files_table->name = $fileName;
      $files_table->entity_name = 'members';
      $files_table->ext = $extension;
      $files_table->type = 'profile';
      $files_table->entitiy_id = $entitiy_id;   
      $files_table->save();

      // move file in dericory
      $file->move($destinationPath,$fileName);
      // -----------------------------------------

      $old_files_table = Files::findOrFail($fileExist[0]->id);
 
                 // update service image in file table
                 $old_files_table->name = $fileName;
                 $old_files_table->ext = $extension;
                 $old_files_table->update();

                 $file->move($destinationPath,$fileName);
   }
   
}