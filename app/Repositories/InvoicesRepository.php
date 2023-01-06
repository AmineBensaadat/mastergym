<?php
namespace App\Repositories;

use App\Models\Invoices;

class InvoicesRepository 
{
    public function addInvoice($request, $memberId){
        $user_id= auth()->user()->id;
        $invoices = Invoices::create([
            'member_id'  => $memberId,
            'subscription_price' => $request['subscription_price'],
            'amount_pending' => $request['amount_pending'],
            'discount' => $request['discount'],
            'discount_amount' => $request['discount_amount'],
            'payment_mode' => $request['payment-mode'],
            'additional_fees' => $request['additional_fees'],
            'payment_comment' => $request['payment_comment'],
            'status' => $request['status'],
            'created_by' =>  $user_id,
            'updated_by' =>  $user_id,

        ]);
       return $invoices;
    }

}