<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable  = 
    [
        'firstname',
        'lastname',
        'DOB',
        'email',
        'city',
        'address',
        'status',
        'phone',
        'emergency_contact',
        'gender',
        'health_issues',
        'cin',
        'created_by',
        'updated_by',
        'account_id'
    ];
    protected $table = 'coach';
    use HasFactory;
}
