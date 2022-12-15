<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GymsController extends Controller{

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
    public function index()
    {
        $gyms = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->join('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('gyms.id as gym_id', 'files.name as gym_img','files.ext','gyms.name as gym_name', 'gyms.created_at as gym_created_at', 'users.name as user_name')
            ->orderBy("gyms.created_at", "asc")->get();
        //$gyms = Gyms::orderBy("created_at", "asc")->get();
        return view('gym.gym_lists', compact('gyms'));

    }

    /**
     * Show all gym.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('gym.gym_create');
    }

    public function store(Request $request)
    {
        //dd($request->file('profile_image'),  $request->hasfile('file'), $request->file('file'));
        $user_id = auth()->user()->id;
        //validation form 
          $this->validate(
                $request, 
                    [
                        'gym_name' => 'required',
                        'gym_address' => 'required',
                        'gym_phone' => 'regex:/[0-9]/',
                        'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ],
                    [
                        'gym_name.required' => __('translation.require_gym_name'),
                        'gym_address.required' => __('translation.require_gym_address'),
                        'gym_phone.regex' => __('translation.require_gym_phone'),
                        'profile_image' =>   __('translation.file_not_autorized')
                    ],
                );

            
           
        // save gym in gym table
        $gym= new Gyms();
        $gym->name = $request['gym_name'];
        $gym->phone = $request['gym_phone'];
        $gym->address = $request['gym_address'];
        $gym->desc = $request['gym_desc'];
        $gym->is_main = $request['is_main'];
        $gym->created_by = $user_id;
        $gym->save();
        
        // save gym profile image
        $file = $request->file('profile_image');
        if($file = $request->hasFile('profile_image')) {

            // file data 
            $file = $request->file('profile_image') ;
            $fileName = time().rand(100,999).preg_replace('/\s+/', '', $file->getClientOriginalName());
            $destinationPath = public_path().'/assets/images/gyms/' ;
            $extension = $request->file('profile_image')->extension();

            // save gym image in file table
            $files_table= new Files();
            $files_table->name = $fileName;
            $files_table->ext = $extension;
            $files_table->type = 'profile';
            $files_table->entitiy_id = $gym->id;   
            $files_table->save();

            // move file in dericory
            $file->move($destinationPath,$fileName);

        }else{
             // save gym image in file table
             $files_table= new Files();
             $files_table->name = "Simply-Gym-Logo.png";
             $files_table->ext = "png";
             $files_table->type = 'profile';
             $files_table->entitiy_id = $gym->id;   
             $files_table->save();
        }


        return redirect()->route('gym_list');
    }

     /**
     * Show all gym.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $gym = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->join('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('files.name as gym_img','files.ext','gyms.name as gym_name', 'gyms.created_at as gym_created_at', 'users.name as user_name')
            ->where('gyms.id', $id)->first();

       
        return view('gym.gym_show', 
            array(
            "gym_name"  => $gym->gym_name,
            "gym_img" => $gym->gym_img,
            "ext" => $gym->ext 
       ));
    }
}