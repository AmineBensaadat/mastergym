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
        'updated_by',
        'cin'
    ];
    
    protected $table = 'members';
    use HasFactory;
}
