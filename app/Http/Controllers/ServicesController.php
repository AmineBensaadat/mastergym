<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Service;
use App\Models\Services;
use App\Models\ServicesGyms;
use App\Repositories\FilesRepository;
use App\Repositories\GymsRepository;
use App\Repositories\ServicesRepository;
use App\Repositories\UserRepository;
use App\Rules\IsSelected;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    private $servicesRepository;
    private $userRepository;
    private $gymsRepository;
    private $filesRepository;

    public function __construct(ServicesRepository $servicesRepository, UserRepository $userRepository,  GymsRepository $gymsRepository, FilesRepository $filesRepository)
    {
        $this->middleware('auth');
        $this->servicesRepository = $servicesRepository;
        $this->userRepository = $userRepository;
        $this->gymsRepository = $gymsRepository;
        $this->filesRepository = $filesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request){
    
        $services = $this->servicesRepository->getAllServices($request);
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
  
        return view('services.list' , compact('services', 'gyms'));
    }

    
    public function add(Request $request)
    {
         // tables
         $services= new Services();
         $services_gyms = new ServicesGyms();
         $files_table= new Files();
         $destinationPath = public_path().'/assets/images/services/' ;
         $user = auth()->user();

        //validation form 
        $this->validate(
        $request, 
            [
                'serviceName' => 'required',
                'description' => 'required',
                'service_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gym' => new IsSelected,
            ],
            [
                'serviceName.required' => __('translation.require_gym_name'),
                'description.required' => __('translation.require_gym_address'),
                'service_image' =>   __('translation.file_not_autorized'),
                'gym.required' => __('require'),
            ],
        );

        // save service in service table
        $services->name = $request['serviceName'];
        $services->description = $request['description'];
        $services->created_by = $user->id;
        $services->updated_by = $user->id;
        $services->account_id = $user->account_id;
        $services->save();

        // save services_gyms in services_gyms table
        $services_gyms->service_id = $services->id;
        $services_gyms->gym_id = $request['gym'];
        $services_gyms->save();

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

    public function update(Request $request)
    {
         // tables
         $service = Services::findOrFail($request['service_id']);
         $service_gym = ServicesGyms::findOrFail($request['service_gym_id']);
        
         $files_table= new Files();
         $destinationPath = public_path().'/assets/images/services/' ;
         $user = auth()->user();

         $fileExist = $this->filesRepository->checkFileByEntityId($request['service_id'], 'services', 'profile');
         
        //validation form 
        $this->validate(
        $request, 
            [
                'serviceNameUpdate' => 'required',
                'descriptionUpdate' => 'required',
                'service_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gymUpdate' => new IsSelected,
            ],
            [
                'serviceNameUpdate.required' => __('translation.require_gym_name'),
                'descriptionUpdate.required' => __('translation.require_gym_address'),
                'service_image' =>   __('translation.file_not_autorized'),
                'gymUpdate.required' => __('require'),
            ],
        );

        // update service in service table
        $service->name = $request['serviceNameUpdate'];
        $service->description = $request['descriptionUpdate'];
        $service->updated_by = $user->id;
        $service->update();

        // update services_gyms in services_gyms table
        $service_gym->gym_id = $request['gymUpdate'];
        $service_gym->update();

        // save service profile image
    
        $file = $request->file('service_image_update');
        if($file = $request->hasFile('service_image_update')) {
            $file = $request->file('service_image_update') ;
            $extension = $request->file('service_image_update')->extension();
            $fileName = "profile_image_service_".$request['service_id'].'.'.$extension;


            if(count($fileExist) > 0){ // update

                $old_files_table = Files::findOrFail($fileExist[0]->id);

                // update service image in file table
                $old_files_table->name = $fileName;
                $old_files_table->ext = $extension;
                $old_files_table->update();

            }else{ // insert

            // save gym image in file table
            $files_table->name = $fileName;
            $files_table->ext = $extension;
            $files_table->type = 'profile';
            $files_table->entity_name = 'services';
            $files_table->entitiy_id = $service->id;   
            $files_table->save();
            }

            // move file in dericory
            $file->move($destinationPath,$fileName);

        }

        return redirect()->route('services_list');
    }
}
