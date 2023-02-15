<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gyms extends Model
{
    protected $fillable  = 
    [
        'name',
        'desc',
        'address',
        'is_main',
        'phone',
        'created_at',
        'updated_at',
        'created_by',
        'account_id'
    ];
    protected $table = 'gyms';
    use HasFactory;
}
