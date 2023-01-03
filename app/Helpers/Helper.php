<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Repositories\FilesRepository;
use App\Repositories\ServicesRepository;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Helper
{
    private $filesRepository;
    public function __construct(
        FilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
    } 
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function dateDiff($date_start, $date_end)
    {
        return round(abs(strtotime($date_start) - strtotime($date_end))/86400); 
    }

    public static function getImageByEntityId($entitiy_id, $entity_name){
        $result = DB::table('files')
            ->select('files.name as file_name')
            ->where('files.entitiy_id', $entitiy_id)
            ->where('files.entity_name', $entity_name)
            ->get();

            if(count($result) > 0){
                return $result[0]->file_name;
            }
            return null;
    }
}
