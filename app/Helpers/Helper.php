<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use DateTime;
use Illuminate\Support\Facades\Date;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function dateDiff($date_start, $date_end)
    {
        return round(abs(strtotime($date_start) - strtotime($date_end))/86400); 
    }
}
