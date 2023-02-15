<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersGym extends Model
{
    protected $fillable  = 
    [
        'gym_id',
        'user_id'
    ];
    protected $table = 'users_gyms';
    use HasFactory;
}
