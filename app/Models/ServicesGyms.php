<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ServicesGyms extends Model
{
    protected $fillable  = 
    [
        'service_id',
        'gym_id'
    ];
    
    protected $table = 'services_gyms';
    use HasFactory;
}
