<?php

namespace App\Http\Controllers;

use App\Imports\MembersImport;
use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Repositories\FilesRepository;
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
use Maatwebsite\Excel\Facades\Excel;

class MembersController extends Controller
{
    private $membersRepository;
    private $gymsRepository;
    private $servicesRepository;
    private $subscriptionsRepository;
    private $invoicesRepository;
    private $plansRepository;
    private $filesRepository;

    public function __construct(
        MembersRepository $membersRepository,
        GymsRepository $gymsRepository,
        ServicesRepository $servicesRepository,
        SubscriptionsRepository $subscriptionsRepository,
        InvoicesRepository $invoicesRepository,
        PlansRepository $plansRepository,
        FilesRepository $filesRepository)
    {
        $this->membersRepository = $membersRepository;
        $this->gymsRepository = $gymsRepository;
        $this->servicesRepository = $servicesRepository;
        $this->subscriptionsRepository = $subscriptionsRepository;
        $this->invoicesRepository = $invoicesRepository;
        $this->plansRepository = $plansRepository;
        $this->filesRepository = $filesRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $members = $this->membersRepository->all();
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();
        $error = false;
        return view('members.list', compact('members', 'gyms', 'services', 'error'));
    }

    public function getAllMembers(Request $request)
    {
        $result = $this->membersRepository->getAllMembersByFilters($request);
        $recordsTotal = $this->membersRepository->countAllMembers($request);
        $url = url('/assets/images/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0">
                    <img src="'.$url.'//members/'.(file_exists($this->filesRepository->getFileByEntityId($row->id, "members")) ? $this->filesRepository->getFileByEntityId($row->id, "members"): 'default.jpg').'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$url.'//gyms/'.(file_exists('assets/images/gyms/'.$this->filesRepository->getFileByEntityId($row->id, "gyms")) ? $this->filesRepository->getFileByEntityId($row->id, "gyms"): 'default.png').'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//services/'.(file_exists('assets/images/services/'.$this->filesRepository->getFileByEntityId($row->id, "services")) ? $this->filesRepository->getFileByEntityId($row->id, "services"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->service_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }

            if($row->plan_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//plans/'.(file_exists('assets/images/plans/'.$this->filesRepository->getFileByEntityId($row->id, "plans")) ? $this->filesRepository->getFileByEntityId($row->id, "plans"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }
            $sub_array[] = $row->phone;
            $sub_array[] = $row->cin;
            $sub_array[] = $row->city;
            $sub_array[] = $row->address;
            $sub_array[] = $row->DOB;
            if($row->status == 1){
                $sub_array[] = '<span class="badge text-bg-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge text-bg-dark">Inactive</span>';   
            }
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

    public function getMonthlyJoiningsMembers(Request $request)
    {
        $result = $this->membersRepository->getMonthlyJoiningsMembers($request);
        $recordsTotal = $this->membersRepository->countMonthlyJoiningsMembers($request);
        $url = url('/assets/images/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0">
                    <img src="'.$url.'//members/'.(file_exists($this->filesRepository->getFileByEntityId($row->id, "members")) ? $this->filesRepository->getFileByEntityId($row->id, "members"): 'default.jpg').'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$url.'//gyms/'.(file_exists('assets/images/gyms/'.$this->filesRepository->getFileByEntityId($row->id, "gyms")) ? $this->filesRepository->getFileByEntityId($row->id, "gyms"): 'default.png').'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//services/'.(file_exists('assets/images/services/'.$this->filesRepository->getFileByEntityId($row->id, "services")) ? $this->filesRepository->getFileByEntityId($row->id, "services"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->service_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }

            if($row->plan_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//plans/'.(file_exists('assets/images/plans/'.$this->filesRepository->getFileByEntityId($row->id, "plans")) ? $this->filesRepository->getFileByEntityId($row->id, "plans"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }
            $sub_array[] = $row->phone;
            $sub_array[] = $row->cin;
            $sub_array[] = $row->city;
            $sub_array[] = $row->address;
            $sub_array[] = $row->DOB;
            if($row->status == 1){
                $sub_array[] = '<span class="badge text-bg-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge text-bg-dark">Inactive</span>';   
            }
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

    public function getPendingPaimentMembers(Request $request)
    {
        $result = $this->membersRepository->getPendingPaimentMembers($request);
        $recordsTotal = $this->membersRepository->countMembersByStatus('pending_paiment', $request);
        $url = url('/assets/images/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0">
                    <img src="'.$url.'//members/'.(file_exists('assets/images/members/'.$row->member_img) &&  $row->member_img ? $row->member_img : 'default.jpg').'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$url.'//gyms/'.(file_exists('assets/images/gyms/'.$this->filesRepository->getFileByEntityId($row->id, "gyms")) ? $this->filesRepository->getFileByEntityId($row->id, "gyms"): 'default.png').'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//services/'.(file_exists('assets/images/services/'.$this->filesRepository->getFileByEntityId($row->id, "services")) ? $this->filesRepository->getFileByEntityId($row->id, "services"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->service_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }

            if($row->plan_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//plans/'.(file_exists('assets/images/plans/'.$this->filesRepository->getFileByEntityId($row->id, "plans")) ? $this->filesRepository->getFileByEntityId($row->id, "plans"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }
            $sub_array[] = $row->phone;
            $sub_array[] = $row->cin;
            $sub_array[] = $row->city;
            $sub_array[] = $row->address;
            $sub_array[] = $row->DOB;
            if($row->status == 1){
                $sub_array[] = '<span class="badge text-bg-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge text-bg-dark">Inactive</span>';   
            }
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

    public function getExpireMembers(Request $request)
    {
        $result = $this->membersRepository->getExpireMembers($request);
        $recordsTotal = $this->membersRepository->countMembersByStatus('expired', $request);
        $url = url('/assets/images/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0">
                    <img src="'.$url.'//members/'.(file_exists('assets/images/members/'.$row->member_img) &&  $row->member_img ? $row->member_img : 'default.jpg').'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$url.'//gyms/'.(file_exists('assets/images/gyms/'.$this->filesRepository->getFileByEntityId($row->id, "gyms")) ? $this->filesRepository->getFileByEntityId($row->id, "gyms"): 'default.png').'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//services/'.(file_exists('assets/images/services/'.$this->filesRepository->getFileByEntityId($row->id, "services")) ? $this->filesRepository->getFileByEntityId($row->id, "services"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->service_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }

            if($row->plan_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$url.'//plans/'.(file_exists('assets/images/plans/'.$this->filesRepository->getFileByEntityId($row->id, "plans")) ? $this->filesRepository->getFileByEntityId($row->id, "plans"): 'default.png').'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }
            $sub_array[] = $row->phone;
            $sub_array[] = $row->cin;
            $sub_array[] = $row->city;
            $sub_array[] = $row->address;
            $sub_array[] = $row->DOB;
            if($row->status == 1){
                $sub_array[] = '<span class="badge text-bg-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge text-bg-dark">Inactive</span>';   
            }
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

    public function import(){
        $members = $this->membersRepository->all();
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();
        return view('members.import', compact('members', 'gyms', 'services'));
    }

    public function storImportMembers(Request $request){
         //validation form
         $this->validate(
            $request,
                [
                    'file'=> 'required|mimes:xlsx,csv,xls'
                ],
                [
                    'file.required' => __('translation.require')
                ],
            );

            $file = $request->file('file');
         if($file = $request->hasFile('file')) {
            try {
                Excel::import(new MembersImport,$request->file('file')->store('files'));
                
            }catch(\Exception $ex){
                $error = $ex->getMessage();
                $members = $this->membersRepository->all();
                $gyms =  $this->gymsRepository->renderAllGymByCretedById();
                $services =  $this->servicesRepository->renderAllServices();
                return view('members.list', compact('members', 'gyms', 'services', 'error'));
                
            }
            $error = false;
            $members = $this->membersRepository->all();
            $gyms =  $this->gymsRepository->renderAllGymByCretedById();
            $services =  $this->servicesRepository->renderAllServices();
            return view('members.list', compact('members', 'gyms', 'services', 'error'));
         }
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
                    //'cin' => 'unique:members',
                    //'address' => 'required',
                    //'phone' => 'unique:members',
                    //'dob' => 'required',
                    //'emergency_contact' => 'unique:members',
                    'gym' => new IsSelected,
                    'start_date' => 'date|nullable',
                    'end_date' => 'date|nullable|after:start_date',
                    //'amount-received' => 'required_unless:subscription-price.*,'
                ],
                [
                    'lastname.required' => __('translation.require'),
                    'firstname.required' => __('translation.require'),
                    //'cin.unique' => __('translation.unique'),
                    //'address.required' => __('translation.require'),
                    //'phone.unique' => __('translation.unique'),
                    //'dob.required' => __('translation.require'),
                    //'emergency_contact.unique' => __('translation.unique'),
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
            return redirect()->route('members_show', array('id' => $member->id));
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
                    'lastname' => 'required',
                    'firstname' => 'required',
                    'cin' => 'unique:members',
                    //'address' => 'required',
                    'phone' => 'unique:members',
                    //'dob' => 'required',
                    'emergency_contact' => 'unique:members',
                    //'gym' => new IsSelected,
                ],
                [
                    'lastname.required' => __('translation.require'),
                    'firstname.required' => __('translation.require'),
                    'cin.unique' => __('translation.unique'),
                    //'address.required' => __('translation.require'),
                    'phone.unique' => __('translation.unique'),
                    //'dob.required' => __('translation.require'),
                    'emergency_contact.unique' => __('translation.unique'),
                    //'gym.required' => __('require'),
                ],
            );

           
            // update member in member table
            $this->membersRepository->updateMember($request);
            return redirect()->route('members_show', [
                'id' => $request['member_id']
            ]);
    }

    public function edit($id)
    {
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
            ->where('members.id', $id)->first();
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();

        return view('members.edit', compact('gyms','member'));
    }

    /**
     * Show member.
     * @param  int  $id
     * @return Response
     */
    public function show($member_id)
    {
        $user = auth()->user();
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
            ->where('members.id', $member_id)
            ->where('members.account_id',  '=', $user->account_id)->first();
            // check if member exist ...
        return view('members.show', array("member"  => $member, "invoices" => $invoices, "plan" => $plan));
    }

    public function downloadExceCanva()
    {
        // return $file;
        $myfile = public_path('assets/canvas/canva_member_import.xlsx');
        return response()->download($myfile);
    }

}
