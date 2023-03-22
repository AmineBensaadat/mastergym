<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Plans;
use App\Models\PlansServices;
use App\Models\Services;
use App\Repositories\FilesRepository;
use App\Repositories\PlansRepository;
use App\Repositories\ServicesRepository;
use App\Rules\IsSelected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PlansController extends Controller{

    private $servicesRepository;
    private $filesRepository;
    private $plansRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServicesRepository $servicesRepository, FilesRepository $filesRepository, PlansRepository $plansRepository)
    {
        $this->middleware('auth');
        $this->servicesRepository = $servicesRepository;
        $this->filesRepository = $filesRepository;
        $this->plansRepository = $plansRepository;
    }

    public function getPlansBySrvice() {
        $serviceId = $_POST['serviceId'];
        
        $plans = Plans::select('id','plan_name', 'days', 'amount')
                ->where('service_id', $serviceId)
                ->get();
        return response()->json(array('plans'=> $plans), 200);
    }

    public function getPlansDays() {
        $planId = $_POST['planId'];
        
        $plans = Plans::select('id','plan_name', 'days', 'amount')
                ->where('id', $planId)
                ->get();
        return response()->json(array('plans'=> $plans[0]), 200);
    }

    /**
     * Show all gym.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $plans = $this->plansRepository->getAllSPlansByAccount($request);

        return view('plans.list' , compact('plans'));
    }

    /**
     * Show create plan.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $services =$this->servicesRepository->getAllServicesByAccount_id();
        return view('plans.plans_create', compact('services'));
    }

    /**
     * Show create plan.
     *
     * @return Response
     */
    public function edit($id)
    {
        $services =  $this->servicesRepository->renderServicesChosed($id);
        $plans_services =  PlansServices::where('plan_id', '=', $id)->get();
        $plan = Plans::findOrFail($id);
        // dd($services[1]->id, $plan->service_id);
        return view('plans.edit', compact('services', 'plan', 'plans_services'));
    }

    public function store(Request $request)
    {
         // tables
         $palns= new Plans();
         $plans_services = new PlansServices();
         $user = auth()->user();
         $destinationPath = public_path().'/assets/images/plans/'.$user->account_id.'/' ;
        //validation form 
        $this->validate(
        $request, 
            [
                'plan_name' => 'required',
                'plan_day' => 'required',
                'plan_day' => 'required',
                'service' => 'required',
                'plan_amount' => 'required',
            ],
            [
                'plan_name.required' => __('translation.require_plan_name'),
                'plan_day.required' => __('translation.this_filed_required'),
                'profile_image' =>   __('translation.file_not_autorized'),
                'service.required' =>   __('translation.service_required'),
                'plan_amount.required' =>   __('translation.plan_amount'),
            ],
        );

        // save plan in plans table
        $palns->plan_name = $request['plan_name'];
        $palns->plan_details = $request['plan_desc'];
        $palns->days = $request['plan_day'];
        $palns->amount = $request['plan_amount'];
        $palns->status = $request['status'];
        $palns->created_by = $user->id;
        $palns->updated_by = $user->id;
        $palns->account_id = $user->account_id;
        $palns->save();

         // save plans services
         if(count($request['service']) > 0){
                foreach($request['service'] as $service){
                    $data = array(
                    'service_id' => $service,
                    'plan_id' => $palns->id
                    );
                    $plans_services::insert($data);
                }
        }


        // save plan profile image
        $file = $request->file('profile_image');
        if($file = $request->hasFile('profile_image')) {

             // save the file
             try {
                $extension = $request->file('profile_image')->extension();
                $fileName = "plan_image_".$request['plan_name']."_".$palns->id.'_'.time().'.'.$extension;
                $this->filesRepository->saveFile($request, $palns->id, $fileName ,$destinationPath, 'plans', 'profile', 'profile_image');
            } catch (Throwable $e) {
                report($e);
        
                return $e;
            }

        }

        return redirect()->route('plans_list');
    }

    public function update(Request $request)
    {
        // tables
        $plan = Plans::findOrFail($request['plan_id']);
        $plans_services = new PlansServices();
        
         
        $files_table= new Files();
        $user = auth()->user();
        $destinationPath = public_path().'/assets/images/plans/'.$user->account_id.'/' ;

        $fileExist = $this->filesRepository->checkFileByEntityId($request['plan_id'], 'plans', 'profile');
       //validation form 
       $this->validate(
       $request, 
            [
                'plan_name' => 'required',
                'plan_day' => 'required',
                'plan_day' => 'required',
                'service' => 'required',
            ],
            [
                'plan_name.required' => __('translation.require_plan_name'),
                'plan_day.required' => __('translation.this_filed_required'),
                'profile_image' =>   __('translation.file_not_autorized'),
                'service.required' =>   __('translation.service_required'),
            ]
       );

       // update plan in plans table
        $plan->plan_name = $request['plan_name'];
        $plan->plan_details = $request['plan_desc'];
        $plan->days = $request['plan_day'];
        $plan->amount = $request['plan_amount'];
        $plan->status = $request['status'];
        $plan->updated_by = $user->id;
        $plan->update();

         // save plans services
        if(count($request['service']) > 0){
            PlansServices::where('plan_id', '=', $request['plan_id'])->delete();
                foreach($request['service'] as $service){
                    $data = array(
                    'service_id' => $service,
                    'plan_id' => $request['plan_id']
                    );
                    $plans_services::insert($data);
                }
        }


       // save plan profile image
       $file = $request->file('profile_image');
       if($file = $request->hasFile('profile_image')) {
           // save the file
           try {
            $extension = $request->file('profile_image')->extension();
            $fileName = "plan_image_".$request['plan_name']."_".$request['plan_id'].'_'.time().'.'.$extension;
            $this->filesRepository->saveFile($request, $request['plan_id'], $fileName ,$destinationPath, 'plans', 'profile', 'profile_image');
        } catch (Throwable $e) {
            report($e);
    
            return $e;
        }

       }

       return redirect()->route('plans_list');
    }


     /**
     * Show all gym.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $gym = DB::table('plans')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->join('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('files.name as gym_img','files.ext','gyms.name as gym_name', 'gyms.created_at as gym_created_at', 'users.name as user_name')
            ->where('gyms.id', $id)->first();


        return view('gym.show',
            array(
            "gym_name"  => $gym->gym_name,
            "gym_img" => $gym->gym_img,
            "ext" => $gym->ext
       ));
    }
}