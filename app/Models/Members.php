<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Members extends Model
{
    protected $fillable  = 
    [
        'firstname',
        'lastname',
        'DOB',
        'email',
        'city',
        'address', 
        'gender',
        'status',
        'phone',
        'emergency_contact',
        'health_issues',
        'source',  
        'created_by', 
        'created_at',  
        'updated_by',
        'cin',
        'account_id',
        'service_id',
        'gym_id'
    ];
    
    protected $table = 'members';
    use HasFactory;
}
