<?php
namespace App\Http\Controllers;

use App\Repositories\CoachRepository;
use App\Repositories\GymsRepository;
use App\Repositories\ServicesRepository;
use App\Rules\IsSelected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CoachController extends Controller{

    private $servicesRepository;
    private $gymsRepository;
    private $coachRepository;

    public function __construct(ServicesRepository $servicesRepository,  GymsRepository $gymsRepository, CoachRepository $coachRepository)
    {
        $this->middleware('auth');
        $this->servicesRepository = $servicesRepository;
        $this->gymsRepository = $gymsRepository;
        $this->coachRepository = $coachRepository;
    }

    public function list(Request $request){
        $services = $this->servicesRepository->getAllServices($request);
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        return view('coach.list' , compact('services', 'gyms'));
    }

    public function create(){
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        return view('coach.create', compact('gyms'));
    }

    public function store(Request $request){
        //validation form
        $this->validate(
            $request,
                [
                    'lastname' => 'required',
                    'firstname' => 'required',
                    'created_at' => 'required',
                    'gym' => new IsSelected
                ],
                [
                    'lastname.required' => __('translation.require'),
                    'firstname.required' => __('translation.require'),
                    'created_at.required' => __('translation.require'),
                    'gym.required' => __('require')
                ],
            );
        
        // save Coach in coach table
        $coach = $this->coachRepository->saveCoach($request);

        dd($coach);
    }

}
