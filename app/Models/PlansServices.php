<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlansServices extends Model
{
    protected $fillable  = 
    [
        'service_id',
        'plan_id',
        'created_at',  
        'updated_by',
    ];
    protected $table = 'plans_services';
    use HasFactory;
}
