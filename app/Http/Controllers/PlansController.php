<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Plans;
use App\Models\Services;
use App\Repositories\FilesRepository;
use App\Repositories\ServicesRepository;
use App\Rules\IsSelected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlansController extends Controller{

    private $servicesRepository;
    private $filesRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServicesRepository $servicesRepository, FilesRepository $filesRepository)
    {
        $this->middleware('auth');
        $this->servicesRepository = $servicesRepository;
        $this->filesRepository = $filesRepository;
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
        if($request->isMethod('get')){
            $query = $request['query'];
            $plans = Plans::select('plans.id','plan_name', 'plan_details', 'plans.service_id')
                ->where('plan_name','LIKE','%'.$query.'%')
                ->orWhere('plan_details', 'like', '%'. $query .'%')
                ->paginate(10);
            $count = $plans->count();
            return view('plans.list' , compact('plans', 'count'));
        }else{
            $plans = Plans::paginate(10);
            $count = $plans->count();
            return redirect()->route('list');
        }

        return view('plans.list' , compact('plans', 'count'));
    }

    /**
     * Show create plan.
     *
     * @return Response
     */
    public function create()
    {
        $services = Services::all();
        return view('plans.plans_create', compact('services'));
    }

       /**
     * Show create plan.
     *
     * @return Response
     */
    public function edit($id)
    {
        $services = Services::all();
        $plan = Plans::findOrFail($id);
        return view('plans.edit', compact('services', 'plan'));
    }

    public function store(Request $request)
    {
         // tables
         $palns= new Plans();
         $files_table= new Files();
         $destinationPath = public_path().'/assets/images/plans/' ;
         $user = auth()->user();

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
            ],
        );

        // save plan in plans table
        $palns->plan_name = $request['plan_name'];
        $palns->plan_details = $request['plan_desc'];
        $palns->service_id = $request['service'];
        $palns->days = $request['plan_day'];
        $palns->amount = $request['plan_amount'];
        $palns->status = $request['status'];
        $palns->created_by = $user->id;
        $palns->updated_by = $user->id;
        $palns->account_id = $user->account_id;
        $palns->save();

        // save plan profile image
        $file = $request->file('profile_image');
        if($file = $request->hasFile('profile_image')) {

            // file data 
            $file = $request->file('profile_image') ;
            $fileName = time().rand(100,999).preg_replace('/\s+/', '', $file->getClientOriginalName());
            $extension = $request->file('profile_image')->extension();

            // save plan image in file table
            $files_table= new Files();
            $files_table->name = $fileName;
            $files_table->ext = $extension;
            $files_table->entity_name = 'plans';
            $files_table->type = 'profile';
            $files_table->entitiy_id = $palns->id;   
            $files_table->save();

            // move file in dericory
            $file->move($destinationPath,$fileName);

        }

        return redirect()->route('plans_list');
    }

    public function update(Request $request)
    {
        // tables
        $plan = Plans::findOrFail($request['plan_id']);
       
        $files_table= new Files();
        $destinationPath = public_path().'/assets/images/plans/' ;
        $user = auth()->user();

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
        $plan->service_id = $request['service'];
        $plan->days = $request['plan_day'];
        $plan->amount = $request['plan_amount'];
        $plan->status = $request['status'];
        $plan->updated_by = $user->id;
        $plan->update();


       // save plan profile image
   
       $file = $request->file('profile_image');
       if($file = $request->hasFile('profile_image')) {
           $file = $request->file('profile_image') ;
           $extension = $request->file('profile_image')->extension();
           $fileName = "profile_image_plan_".$request['service_id'].'.'.$extension;


           if(count($fileExist) > 0){ // update

               $old_files_table = Files::findOrFail($fileExist[0]->id);

               // update service image in file table
               $old_files_table->name = $fileName;
               $old_files_table->ext = $extension;
               $old_files_table->update();

           }else{ // insert

           // save plan image in file table
           $files_table->name = $fileName;
           $files_table->ext = $extension;
           $files_table->type = 'profile';
           $files_table->entity_name = 'plans';
           $files_table->entitiy_id = $plan->id;   
           $files_table->save();
           }

           // move file in dericory
           $file->move($destinationPath,$fileName);

       }

       return redirect()->route('edit_plan', [
        'id' => $request['plan_id']
    ]);
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