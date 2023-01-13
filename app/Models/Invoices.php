<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'member_id',
        'service_id',
        'plan_id',
        'subscription-price',
        'amount_pending',
        'discount',
        'amount_received',
        'discount_amount',
        'payment_mode',
        'additional_fees',
        'payment_comment',
        'status',
        'created_by',
        'updated_by'
    ];
    use HasFactory;
}
