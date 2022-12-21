<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Plans;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlansController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            $plans = Plans::select('id','plan_name', 'plan_details')
                ->where('plan_name','LIKE','%'.$query.'%')
                ->orWhere('plan_details', 'like', '%'. $query .'%')
                ->paginate(10);
            $count = $plans->count();
            return view('plans.plans_list' , compact('plans', 'count'));
        }else{
            $plans = Plans::paginate(10);
            $count = $plans->count();
            return redirect()->route('plans_list');
        }

        return view('plans.plans_list' , compact('plans', 'count'));
    }

    /**
     * Show create plan.
     *
     * @return Response
     */
    public function create()
    {
        $services = Services::all();
        //dd($services);
        return view('plans.plans_create', compact('services'));
    }

    public function store(Request $request)
    {
         // tables
         $palns= new Plans();
         $files_table= new Files();
         $destinationPath = public_path().'/assets/images/plans/' ;
         $user_id = auth()->user()->id;

        //validation form 
        $this->validate(
        $request, 
            [
                'plan_name' => 'required',
                'plan_day' => 'required',
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'plan_name.required' => __('translation.require_plan_name'),
                'plan_day.required' => __('translation.this_filed_required'),
                'profile_image' =>   __('translation.file_not_autorized'),
            ],
        );

        // save plan in plans table
        $palns->plan_name = $request['plan_name'];
        $palns->plan_details = $request['plan_desc'];
        $palns->service_id = $request['service'];
        $palns->days = $request['plan_day'];
        $palns->amount = $request['plan_amount'];
        $palns->status = $request['status'];
        $palns->created_by = $user_id;
        $palns->updated_by = $user_id;
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
            $files_table->type = 'profile';
            $files_table->entitiy_id = $palns->id;   
            $files_table->save();

            // move file in dericory
            $file->move($destinationPath,$fileName);

        }else{
            // save plan image in file table
            $files_table= new Files();
            $files_table->name = "plan_Logo.jpg";
            $files_table->ext = "png";
            $files_table->type = 'profile';
            $files_table->entitiy_id = $palns->id;   
            $files_table->save();
        }



        return redirect()->route('plans_list');
    }
}