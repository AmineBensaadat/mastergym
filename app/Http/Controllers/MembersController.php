<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Repositories\GymsRepository;
use App\Repositories\InvoicesRepository;
use App\Repositories\MembersRepository;
use App\Repositories\PlansRepository;
use App\Repositories\ServicesRepository;
use App\Repositories\SubscriptionsRepository;
use App\Rules\IsSelected;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;


class MembersController extends Controller
{
    private $membersRepository;
    private $gymsRepository;
    private $servicesRepository;
    private $subscriptionsRepository;
    private $invoicesRepository;
    private $plansRepository;

    public function __construct(
        MembersRepository $membersRepository,
        GymsRepository $gymsRepository,
        ServicesRepository $servicesRepository,
        SubscriptionsRepository $subscriptionsRepository,
        InvoicesRepository $invoicesRepository,
        PlansRepository $plansRepository)
    {
        $this->membersRepository = $membersRepository;
        $this->gymsRepository = $gymsRepository;
        $this->servicesRepository = $servicesRepository;
        $this->subscriptionsRepository = $subscriptionsRepository;
        $this->invoicesRepository = $invoicesRepository;
        $this->plansRepository = $plansRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $members = $this->membersRepository->all();
        return view('members.list', compact('members'));
    }

    public function getAllMembers(Request $request)
    {
        $result = $this->membersRepository->getAllMembersByFilters($request);
        $recordsTotal = $this->membersRepository->countAllMembers();
        $url = url('/assets/images/members/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0">
                    <img src="'.$url.'/'.(file_exists($row->img_name) ? $row->img_name : 'default.jpg').'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->lastname. ' '.$row->firstname.'</div>            
            </div>';
            $sub_array[] = $row->gym_name;
            $sub_array[] = $row->address;
            $sub_array[] = $row->email;
            $sub_array[] = $row->phone;
            $sub_array[] = $row->DOB;
            $data[] = $sub_array;
        }

        $number_filter_row = count($result["result"]);
        $output = array(
            "draw"       =>  intval($request["draw"]),
            "recordsTotal"   =>  $recordsTotal ,
            "recordsFiltered"  => $number_filter_row,
            "data"       =>  $data
           );

        return json_encode($output) ;
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();

        return view('members.create', compact('gyms','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //validation form
        $this->validate(
            $request,
                [
                    'lastname' => 'required',
                    'firstname' => 'required',
                    'cin' => 'unique:members',
                    'address' => 'required',
                    'phone' => 'unique:members',
                    'dob' => 'required',
                    'emergency_contact' => 'unique:members',
                    'gym' => new IsSelected,
                    'start_date' => 'date|nullable',
                    'end_date' => 'date|nullable|after:start_date',
                    'amount-received' => 'required_unless:subscription-price.*,'
                ],
                [
                    'lastname.required' => __('translation.require'),
                    'firstname.required' => __('translation.require'),
                    'cin.unique' => __('translation.unique'),
                    'address.required' => __('translation.require'),
                    'phone.unique' => __('translation.unique'),
                    'dob.required' => __('translation.require'),
                    'emergency_contact.unique' => __('translation.unique'),
                    'gym.required' => __('require'),
                    'start_date' => __('require'),
                    'end_date' => __('require'),
                ],
            );
            // save member in member table
            $member = $this->membersRepository->saveMember($request);

             // save subscription
            if($request['service'] != 0){
               // save subscription in subscription table
                $subscription = $this->subscriptionsRepository->addSubscription($request, $member->id);

                // save invoice in invoices table
                $invoice = $this->invoicesRepository->addInvoice($request, $member->id);
            }

            return redirect()->route('members_list');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        $user->status = $request->status;

        $user->update();
        $user->photo = \constFilePrefix::staffPhoto.$user->id.'.jpg';
        $user->save();

        \Utilities::uploadFile($request, \constFilePrefix::staffPhoto, $user->id, 'photo', \constPaths::staffPhoto);

        flash()->success('User details was successfully updated');

        return redirect('users');
    }

    /**
     * Show member.
     * @param  int  $id
     * @return Response
     */
    public function show($member_id)
    {
        $invoices = $this->invoicesRepository->getMemberInvoices($member_id);
        $plan = $this->plansRepository->getMemberPlan($member_id);
        $member = DB::table('members')
            ->leftJoin('files', 'members.id', '=', 'files.entitiy_id')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->select(
                'files.name as img_name','members.*',
                'subscriptions.id as subscription_id',
                'subscriptions.start_date',
                'subscriptions.start_date',
                'subscriptions.end_date',
            )
            ->where('members.id', $member_id)->first();
        return view('members.show', array("member"  => $member, "invoices" => $invoices, "plan" => $plan));
    }

}
