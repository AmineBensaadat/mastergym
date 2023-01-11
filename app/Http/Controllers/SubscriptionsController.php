<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Repositories\GymsRepository;
use App\Repositories\InvoicesRepository;
use App\Repositories\MembersRepository;
use App\Repositories\ServicesRepository;
use App\Repositories\SubscriptionsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubscriptionsController extends Controller
{
    private $membersRepository;
    private $subscriptionsRepository;
    private $servicesRepository;
    private $gymsRepository;
    private $invoicesRepository;

    public function __construct(InvoicesRepository $invoicesRepository, ServicesRepository $servicesRepository,GymsRepository $gymsRepository, MembersRepository $membersRepository, SubscriptionsRepository $subscriptionsRepository)
    {
        $this->membersRepository = $membersRepository;
        $this->gymsRepository = $gymsRepository;
        $this->servicesRepository = $servicesRepository;
        $this->subscriptionsRepository = $subscriptionsRepository;
        $this->invoicesRepository = $invoicesRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $subscriptions = $this->subscriptionsRepository->getAllSucription();
        return view('subscriptions.list', compact('subscriptions'));
    }

    public function renwe($subscription_id, $member_id){

        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();
        return view('subscriptions.renew', compact('gyms', 'services', 'subscription_id', 'member_id'));
    
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function add()
    {
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();
        return view('subscriptions.create', compact('gyms','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        //validation form 
        $this->validate(
            $request, 
                [
                    'start_date' => 'date|nullable',
                    'end_date' => 'date|nullable|after:start_date',
                    'amount-received' => 'required_unless:subscription_price.*,'
                ],
                [
                    'start_date' => __('require'),
                    'end_date' => __('require'),
                ],
            );
             // save subscription
            if($request['service'] != 0){
                $invoice = $this->invoicesRepository->addInvoice($request, $request->member_id);

               // save subscription in subscription table
                $subscription = $this->subscriptionsRepository->updateSubscription($request, $request->subscription_id, $invoice->id);


            }
          
            return redirect()->route('members_list');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

}
