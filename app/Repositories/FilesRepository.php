<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FilesRepository 
{

    
   public function getFileByEntityId($entitiy_id, $entity_name){
      $result = DB::table('files')
      ->select('files.name as file_name')
      ->where('files.entitiy_id', $entitiy_id)
      ->where('files.entity_name', $entity_name)
      ->get();

      if(count($result) > 0){
          return $result[0]->file_name;
      }
      return "default.png";
   }
   
}