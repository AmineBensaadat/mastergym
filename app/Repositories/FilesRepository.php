<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FilesRepository 
{

    
   public function getFileByEntityId($entitiy_id, $entity_name){
        $result = DB::table('services')
        ->select('services.name as file_name')
        ->where('services.entitiy_id', $entitiy_id)
        ->where('services.entity_name', $entity_name)
        ->get();
        return $result;
   }
   
}