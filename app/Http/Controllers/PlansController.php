<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Plans;
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

    public function add(Request $request)
    {
         // tables
         $palns= new Plans();
         $files_table= new Files();
         $destinationPath = public_path().'/assets/images/plans/' ;
         $user_id = auth()->user()->id;

        //validation form 
        // $this->validate(
        // $request, 
        //     [
        //         'serviceName' => 'required',
        //         'description' => 'required',
        //         'service_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        //     ],
        //     [
        //         'serviceName.required' => __('translation.require_gym_name'),
        //         'description.required' => __('translation.require_gym_address'),
        //         'service_image' =>   __('translation.file_not_autorized')
        //     ],
        // );
        
        // save plan in plans table
        $palns->plan_name = $request['planName'];
        $palns->plan_details = $request['description'];
        $palns->service_id = 1;
        $palns->days = 30;
        $palns->amount = 500;
        $palns->status = 1;
        $palns->created_by = $user_id;
        $palns->updated_by = $user_id;
        $palns->save();

        // save gym profile image
        // $file = $request->file('service_image');
        // if($file = $request->hasFile('service_image')) {

            // file data 
            // $file = $request->file('service_image') ;
            // $fileName = time().rand(100,999).preg_replace('/\s+/', '', $file->getClientOriginalName());
            // $extension = $request->file('service_image')->extension();

            // save gym image in file table
            // $files_table->name = $fileName;
            // $files_table->ext = $extension;
            // $files_table->type = 'profile';
            // $files_table->entitiy_id = $plans->id;   
            // $files_table->save();

            // // move file in dericory
            // $file->move($destinationPath,$fileName);

        // }

        return redirect()->route('plans_list');
    }
}