<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'member_id',
        'plan_id',
        'invoice_id',
        'start_date',
        'end_date',
        'status',
        'service_id',
        'is_renewal',
        'created_by',
        'updated_by'

    ];
    use HasFactory;
}
