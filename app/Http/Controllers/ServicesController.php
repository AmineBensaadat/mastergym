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
use Throwable;

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
         $user = auth()->user();
         $destinationPath = public_path().'/assets/images/services/'.$user->account_id.'/' ;
        

        //validation form 
        $this->validate(
        $request, 
            [
                'serviceName' => 'required',
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gym' => new IsSelected,
            ],
            [
                'serviceName.required' => __('translation.require-service-name'),
                'profile_image' =>   __('translation.file_not_autorized'),
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
        $file = $request->file('profile_image');
        if($file = $request->hasFile('profile_image')) {

             // save the file
             try {
                $extension = $request->file('profile_image')->extension();
                $fileName = "sevice_image_".$request['serviceName']."_".$services->id.'_'.time().'.'.$extension;
                $this->filesRepository->saveFile($request, $services->id, $fileName ,$destinationPath, 'services', 'profile','profile_image');
            } catch (Throwable $e) {
                report($e);
        
                return $e;
            }

        }

        return redirect()->route('services_list');
    }

    public function update(Request $request)
    {
        
         // tables
         $service = Services::findOrFail($request['service_id']);
         
         //$service_gym = ServicesGyms::findOrFail(3);
         //dd($service_gym);
         $user = auth()->user();
         $destinationPath = public_path().'/assets/images/services/'.$user->account_id.'/' ;
        //validation form 
        $this->validate(
        $request, 
            [
                'serviceNameUpdate' => 'required',
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gymUpdate' => new IsSelected,
            ],
            [
                'serviceNameUpdate.required' => __('translation.require-service-name'),
                'profile_image' =>   __('translation.file_not_autorized'),
                'gymUpdate.required' => __('require'),
            ],
        );

        // update service in service table
        $service->name = $request['serviceNameUpdate'];
        $service->description = $request['descriptionUpdate'];
        $service->updated_by = $user->id;
        $service->update();

        // update services_gyms in services_gyms table
        // $service_gym->gym_id = $request['gymUpdate'];
        // $service_gym->update();

        // save service profile image
    
        $file = $request->file('profile_image_update');
        if($file = $request->hasFile('profile_image_update')) {
               // save the file
               try {
                $extension = $request->file('profile_image_update')->extension();
                $fileName = "sevice_image_".$request['serviceName']."_".$request['service_id'].'_'.time().'.'.$extension;
                $this->filesRepository->saveFile($request, $request['service_id'], $fileName ,$destinationPath, 'services', 'profile', 'profile_image_update');
            } catch (Throwable $e) {
                report($e);
        
                return $e;
            }

        }

        return redirect()->route('services_list');
    }
}
