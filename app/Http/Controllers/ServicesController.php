<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Service;
use App\Models\Services;
use App\Repositories\ServicesRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    private $servicesRepository;
    private $userRepository;
    public function __construct(ServicesRepository $servicesRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->servicesRepository = $servicesRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request){
    
        $services = $this->servicesRepository->getAllServices($request);
        $count = 15;
        return view('services.list' , compact('services', 'count'));
    }

    
    public function add(Request $request)
    {
         // tables
         $services= new Services();
         $files_table= new Files();
         $destinationPath = public_path().'/assets/images/services/' ;
         $user_id = auth()->user()->id;

        //validation form 
        $this->validate(
        $request, 
            [
                'serviceName' => 'required',
                'description' => 'required',
                'service_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'serviceName.required' => __('translation.require_gym_name'),
                'description.required' => __('translation.require_gym_address'),
                'service_image' =>   __('translation.file_not_autorized')
            ],
        );

        // save service in service table
        $services->name = $request['serviceName'];
        $services->description = $request['description'];
        $services->created_by = $user_id;
        $services->updated_by = $user_id;
        $services->save();

        // save gym profile image
        $file = $request->file('service_image');
        if($file = $request->hasFile('service_image')) {

            // file data 
            $file = $request->file('service_image') ;
            $fileName = time().rand(100,999).preg_replace('/\s+/', '', $file->getClientOriginalName());
            $extension = $request->file('service_image')->extension();

            // save gym image in file table
            $files_table->name = $fileName;
            $files_table->ext = $extension;
            $files_table->type = 'profile';
            $files_table->entity_name = 'services';
            $files_table->entitiy_id = $services->id;   
            $files_table->save();

            // move file in dericory
            $file->move($destinationPath,$fileName);

        }

        return redirect()->route('services_list');
    }
}
