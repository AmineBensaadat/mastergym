<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Models\Subscriptions;
use App\Repositories\GymsRepository;
use App\Repositories\InvoicesRepository;
use App\Repositories\MembersRepository;
use App\Repositories\PlansRepository;
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
    private $plansRepository;

    public function __construct(PlansRepository $plansRepository, InvoicesRepository $invoicesRepository, ServicesRepository $servicesRepository,GymsRepository $gymsRepository, MembersRepository $membersRepository, SubscriptionsRepository $subscriptionsRepository)
    {
        $this->membersRepository = $membersRepository;
        $this->gymsRepository = $gymsRepository;
        $this->servicesRepository = $servicesRepository;
        $this->subscriptionsRepository = $subscriptionsRepository;
        $this->invoicesRepository = $invoicesRepository;
        $this->plansRepository = $plansRepository;

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

    public function edit($id){

        $subscription = Subscriptions::findOrFail($id);
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();
        $plans_services = $this->plansRepository->getPlansBySrvice($subscription->service_id);
        return view('subscriptions.edit', compact('gyms', 'services', 'subscription', 'plans_services'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function add($id)
    {
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();
        $member = Members::findOrFail($id);
        $member_id = $id;
        return view('subscriptions.create', compact('gyms','services', 'member_id', 'member'));
    }

    public function store(Request $request)
    {
        //validation form
        $this->validate(
            $request,
                [
                    'start_date' => 'date|nullable',
                    'end_date' => 'required',
                    'amount-received' => 'required_unless:subscription-price.*,',
                    'amount-pending' => 'required',
                    
                ],
                [
                    'start_date' => __('require'),
                    'end_date' => __('require'),
                    'amount-pending' => __('require'),
                ],
            );
             // save subscription
            if($request['service'] != 0){
                 // save subscription in subscription table
                 $subscription = $this->subscriptionsRepository->addSubscription($request, $request->member_id);

                 // save invoice in invoices table
                 $invoice = $this->invoicesRepository->addInvoice($request, $request->member_id);
            }

            return redirect()->route('members_show', array('id' => $request->member_id));

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
                    'end_date' => 'required',
                    // 'amount-received' => 'required_unless:subscription-price.*,',
                    // 'amount-pending' => 'required',
                ],
                [
                    'start_date' => __('require'),
                    'end_date' => __('require'),
                    //'amount-pending' => __('require'),
                    
                ],
            );

            $subscription = $this->subscriptionsRepository->updateSubscription($request, $request->subscription_id);
            //  // save subscription
            // if($request['service'] != 0){
            //     $invoice = $this->invoicesRepository->addInvoice($request, $request->member_id);

            //    // save subscription in subscription table
            //     $subscription = $this->subscriptionsRepository->updateSubscription($request, $request->subscription_id, $invoice->id);


            // }

            return redirect()->route('subscriptions_edit', array('subscription_id' => $request->subscription_id));
    }
}
