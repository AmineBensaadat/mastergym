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
        // all gym by user
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->servicesRepository->renderAllServices();
        $error = false;
        return view('members.list', compact('gyms', 'services', 'error'));
    }

    public function expiredMembers(){
         // all gym by user
         $gyms =  $this->gymsRepository->renderAllGymByCretedById();
         $services =  $this->servicesRepository->renderAllServices();
         $error = false;
         return view('members.expired', compact('gyms', 'services', 'error'));
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
                    <img src="'.$this->filesRepository->getFileByEntityId($row->id, "members", "profile").'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$this->filesRepository->getFileByEntityId($row->gym_id, "gyms", "profile").'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$this->filesRepository->getFileByEntityId($row->service_id, "services", "profile").'" alt="" class="avatar-xs">
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
                        <img src="'.$this->filesRepository->getFileByEntityId($row->plan_id, "plans", "profile") .'" alt="" class="avatar-xs">
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
            $sub_array[] = '<div class="hstack gap-3 flex-wrap">
            <center><a class="link-danger fs-15 delete_member" member_id="'.$row->id.'"><i class="ri-delete-bin-line"></i></a></center>
        </div>';
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

    public function getAllExpiredMembers(Request $request)
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
                    <img src="'.$this->filesRepository->getFileByEntityId($row->id, "members", "profile").'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$this->filesRepository->getFileByEntityId($row->gym_id, "gyms", "profile").'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$this->filesRepository->getFileByEntityId($row->service_id, "services", "profile").'" alt="" class="avatar-xs">
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
                        <img src="'.$this->filesRepository->getFileByEntityId($row->plan_id, "plans", "profile") .'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }
            $sub_array[] = '<span class="badge badge-soft-danger fs-11"><i class="ri-time-line align-bottom"></i> '.$row->expired_at.'</span>';
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
        //dd($result);
        $recordsTotal = $this->membersRepository->countMonthlyJoiningsMembers($request);
        $url = url('/assets/images/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0">
                    <img src="'.$this->filesRepository->getFileByEntityId($row->id, "members","profile").'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$this->filesRepository->getFileByEntityId($row->gym_id, "gyms","profile").'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$this->filesRepository->getFileByEntityId($row->service_id, "services","profile").'" alt="" class="avatar-xs">
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
                        <img src="'.$this->filesRepository->getFileByEntityId($row->plan_id, "plans","profile").'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }
            $sub_array[] = date('d-m-Y', strtotime($row->created_at));
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
                    <img src="'.$this->filesRepository->getFileByEntityId($row->id, "members", "profile").'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <center><h5 class="text-danger fs-14 mb-0"> <i class="ri-hand-coin-line fs-13 align-middle"></i> '.$row->amount_pending. ' DH </h5></center>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$this->filesRepository->getFileByEntityId($row->service_id, "services", "profile").'" alt="" class="avatar-xs">
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
                        <img src="'.(file_exists('assets/images/plans/'.$this->filesRepository->getFileByEntityId($row->id, "plans","profile")) ? $this->filesRepository->getFileByEntityId($row->id, "plans","profile"): 'default.png').'" alt="" class="avatar-xs">
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

    public function updatePendingPayment(Request $request){
        // update invoice tbale
        $invoice = $this->invoicesRepository->updateInvoice($request);

        return $invoice;
    }

    public function getPendingPaimentByMember(Request $request)
    {
        $result = $this->membersRepository->getPendingPaimentByMember($request);
        $recordsTotal = $this->membersRepository->countMembersByStatus('pending_paiment_of_user', $request);
        $url = url('/assets/images/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = $row->invoice_id;  
            $sub_array[] = $row->amount_pending;  
            $sub_array[] = '
            <center><h5 class="text-danger fs-14 mb-0"> <i class="ri-hand-coin-line fs-13 align-middle"></i> '.$row->amount_pending. ' DH </h5></center>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$this->filesRepository->getFileByEntityId($row->service_id, "services", "profile").'" alt="" class="avatar-xs">
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
                        <img src="'.$this->filesRepository->getFileByEntityId($row->id, "plans", "profile").'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
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
                    <img src="'.$this->filesRepository->getFileByEntityId($row->id, "members", "profile").'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../members/show/'.$row->id. '">'.$row->lastname. ' '.$row->firstname.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$this->filesRepository->getFileByEntityId($row->id, "gyms", "profile").'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
            if($row->service_id){
                $sub_array[] = '
                <div class="d-flex align-items-center">            
                    <div class="flex-shrink-0 ">
                        <img src="'.$this->filesRepository->getFileByEntityId($row->id, "services", "profile").'" alt="" class="avatar-xs">
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
                        <img src="'.$this->filesRepository->getFileByEntityId($row->id, "plans", "profile").'" alt="" class="avatar-xs">
                    </div>
                    <div class="flex-grow-1 ms-2 name">'.$row->plan_name.'</div>            
                </div>';
            }else{
                $sub_array[] = '';   
            }
            $sub_array[] = '<span class="badge badge-soft-danger fs-11"><i class="ri-time-line align-bottom"></i> '.$row->expired_at.'</span>';
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

        $file = $request->file('file');
        $import = new MembersImport($this->membersRepository);
        $import->import($file);
        //dd($import->errors());
        // try {
        //     $import->import('import-users.xlsx');
        // } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        //      $failures = $e->failures();
             
        //      foreach ($failures as $failure) {
        //          $failure->row(); // row that went wrong
        //          $failure->attribute(); // either heading key (if using heading row concern) or column index
        //          $failure->errors(); // Actual error messages from Laravel validator
        //          $failure->values(); // The values of the row that has failed.
        //      }
        // }
        
        

        return back()->withStatus('excel file imported successfuly');


        //  //validation form
        //  $this->validate(
        //     $request,
        //         [
        //             'file'=> 'required|mimes:xlsx,csv,xls',
        //             'gym' => new IsSelected,
        //         ],
        //         [
        //             'file.required' => __('translation.require'),
        //             'gym.required' => __('require'),
        //         ],
        //     );

        //     $file = $request->file('file');
        //  if($file = $request->hasFile('file')) {
        //     Excel::import(new MembersImport, $request->file('file'));
        //     return back()->withStatus('excel file imported successfuly');
        //     try {
                
                
        //     }catch(\Exception $ex){
        //         $error = $ex->getMessage();
        //         $members = $this->membersRepository->all();
        //         $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        //         $services =  $this->servicesRepository->renderAllServices();
        //         return view('members.list', compact('members', 'gyms', 'services', 'error'));
                
        //     }
        //     // $error = false;
        //     // $members = $this->membersRepository->all();
        //     // $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        //     // $services =  $this->servicesRepository->renderAllServices();
        //     // return view('members.list', compact('members', 'gyms', 'services', 'error'));
        //  }
    }

    public function delete(Request $request){
        $member_id = $request['member_id'];
        $msg  = '';
        try {
            $this->membersRepository->deleteMember($member_id);
            $msg  = 'Member deleted successfully';
            $statu = true;
           

          } catch (\Exception $e) {
            $msg  = 'sorry error occurred when deleting';
            $statu = false;
          }
          
          $output = array(
            "statu"       =>  $statu,
            "msg"   =>  $msg
           );
          return $output;
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
                    'created_at' => 'required',
                    'gym' => new IsSelected,
                    // 'start_date' => 'date|nullable',
                    // 'end_date' => 'required',
                    //'amount-received' => 'required_unless:subscription-price.*,'
                ],
                [
                    'lastname.required' => __('translation.require'),
                    'firstname.required' => __('translation.require'),
                    'created_at.required' => __('translation.require'),
                    //'cin.unique' => __('translation.unique'),
                    //'address.required' => __('translation.require'),
                    //'phone.unique' => __('translation.unique'),
                    //'dob.required' => __('translation.require'),
                    //'emergency_contact.unique' => __('translation.unique'),
                    'gym.required' => __('require'),
                    // 'start_date' => __('require'),
                    // 'end_date' => __('require'),
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
                    'created_at' => 'required',
                    //'cin' => 'unique:members',
                    //'address' => 'required',
                    //'phone' => 'unique:members',
                    //'dob' => 'required',
                    //'emergency_contact' => 'unique:members',
                    //'gym' => new IsSelected,
                ],
                [
                    'lastname.required' => __('translation.require'),
                    'firstname.required' => __('translation.require'),
                    'created_at.required' => __('translation.require'),
                    //'cin.unique' => __('translation.unique'),
                    //'address.required' => __('translation.require'),
                    //'phone.unique' => __('translation.unique'),
                    //'dob.required' => __('translation.require'),
                    //'emergency_contact.unique' => __('translation.unique'),
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
        $services =  $this->servicesRepository->renderAllServices();

        return view('members.edit', compact('gyms','member', 'services'));
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
        $subscription = $this->subscriptionsRepository->getSinglSubscription($member_id);
        $member = DB::table('members')
            ->leftJoin('subscriptions', 'members.id', '=', 'subscriptions.member_id')
            ->select('members.*',
                'subscriptions.id as subscription_id',
                'subscriptions.start_date',
                'subscriptions.start_date',
                'subscriptions.end_date',
            )
            ->where('members.id', $member_id)
            ->where('members.account_id',  '=', $user->account_id)->first();
            // check if member exist ...
        return view('members.show', array("member"  => $member, "invoices" => $invoices, "subscription" => $subscription));
    }

    public function downloadExceCanva()
    {
        // return $file;
        $myfile = public_path('assets/excels/canvas/canva_member_import.xlsx');
        return response()->download($myfile);
    }

    public function getStatus($statu){
        switch ($statu) {
            case 'expired':
                $result = '<span class="badge badge-soft-danger text-uppercase">Expired</span>';
                break;
            default:
                $result = '';

        }
        return $result;
    }

}
