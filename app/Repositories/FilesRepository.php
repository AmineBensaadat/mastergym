<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FilesRepository 
{

    
   public function getFileByEntityId($entitiy_id, $entity_name, $entity_type){
      $result = DB::table('files')
      ->select('files.name as file_name')
      ->where('files.entitiy_id', $entitiy_id)
      ->where('files.entity_name', $entity_name)
      ->where('files.type', $entity_type)
      ->get();

      if(count($result) > 0){
          return $result[0]->file_name;
      }
      return "default.png";
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
   
}