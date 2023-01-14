<?php
namespace App\Repositories;

use App\Models\Invoices;
use Illuminate\Support\Facades\DB;

class InvoicesRepository
{
    public function addInvoice($request, $memberId){
        $user_id= auth()->user()->id;
        $invoices = Invoices::create([
            'member_id'  => $memberId,
            'service_id' => $request['service'],
            'plan_id' => $request['plans'],
            'amount_received' => $request['amount-received'],
            'subscription-price' => $request['subscription-price'],
            'amount_pending' => $request['amount-pending'],
            'discount' => $request['discount'],
            'discount-amount' => $request['discount-amount'],
            'payment-mode' => $request['payment-mode'],
            'additional-fees' => $request['additional-fees'],
            'payment-comment' => $request['payment-comment'],
            'status' => $request['status'],
            'created_by' =>  $user_id,
            'updated_by' =>  $user_id,

        ]);
       return $invoices;
    }

    public function getAllInvoices(){
        $user= auth()->user();
        $invoices = DB::table('invoices')
            ->join('users', 'invoices.created_by', '=', 'users.id')
            ->join('members', 'invoices.member_id', '=', 'members.id')
            ->join('plans', 'invoices.plan_id', '=', 'plans.id')
            ->join('services', 'invoices.service_id', '=', 'services.id')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->select(
                'invoices.*',
                'members.id as member_id',
                'members.firstname',
                'members.lastname',
                'services.id as service_id',
                'files.name as member_img',
                'plans.id as plan_id',
                'plan_name',
                'services.name as service_name')
            ->where('users.account_id', $user->account_id)
            // ->where('services.name','LIKE','%'.$query.'%')
            // ->orWhere('description', 'like', '%'. $query .'%')
            ->paginate(10);
        return $invoices;
    }

    public function getMemberInvoices($member_id){
        $user= auth()->user();
        $invoices = DB::table('invoices')
            ->join('users', 'invoices.created_by', '=', 'users.id')
            ->join('members', 'invoices.member_id', '=', 'members.id')
            ->join('plans', 'invoices.plan_id', '=', 'plans.id')
            ->join('services', 'invoices.service_id', '=', 'services.id')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->select(
                'invoices.*',
                'members.id as member_id',
                'members.firstname',
                'members.lastname',
                'services.id as service_id',
                'files.name as member_img',
                'plans.id as plan_id',
                'plan_name',
                'services.name as service_name')
            ->where('users.account_id', $user->account_id)
            ->where('invoices.member_id', $member_id)
            // ->where('services.name','LIKE','%'.$query.'%')
            // ->orWhere('description', 'like', '%'. $query .'%')
            ->paginate(10);
        return $invoices;
    }

}
