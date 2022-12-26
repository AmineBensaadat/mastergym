<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Members extends Model
{
    protected $fillable  = ['firstname','lastname','DOB','email','address', 'gender','status','contact','emergency_contact','health_issues','source',  'created_by',  'updated_by'];
    
    protected $table = 'members';
    use HasFactory;
}
