<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Repositories\FilesRepository;
use App\Repositories\GymsRepository;
use App\Repositories\MembersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class GymsController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $gymsRepository;
    private $membersRepository;
    private $filesRepository;

    public function __construct(GymsRepository $gymsRepository, MembersRepository $membersRepository, FilesRepository $filesRepository)
    {
        $this->gymsRepository = $gymsRepository;
        $this->membersRepository = $membersRepository;
        $this->filesRepository = $filesRepository;
        $this->middleware('auth');
    }

    /**
     * Show all gym.
     *
     * @return Response
     */
    public function index()
    {
        $gyms = $this->gymsRepository->getAllGymByCretedById();
        return view('gym.lists', compact('gyms'));

    }

    /**
     * Show create gym.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('gym.create');
    }

       /**
     * Switch gym.
     *
     * @return Response
     */
    public function switch(Request $request)
    {
        $user_id = auth()->user()->id;
        $gym_id = $request['gym_id'];
        $msg  = '';

        try {
            $this->gymsRepository->updateDefaultGym_id($gym_id, $user_id);
            $msg  = 'Gym successfully changed';
            $statu = true;
           

          } catch (\Exception $e) {
            $msg  = 'sorry error occurred when changing the gym';
            $statu = false;
            //return $e->getMessage();
          }
          
          $output = array(
            "statu"       =>  $statu,
            "msg"   =>  $msg
           );
          return $output;
    }

    public function store(Request $request)
    {
        // tables
        $gym= new Gyms();
        $user = auth()->user();
        $destinationPath = public_path().'/assets/images/gyms/'.$user->account_id.'/' ;

        //validation form
          $this->validate(
                $request,
                    [
                        'gym_name' => 'required',
                        'gym_address' => 'required',
                        'gym_phone' => 'regex:/[0-9]/',
                        'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'imgs_gallery' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ],
                    [
                        'gym_name.required' => __('translation.require_gym_name'),
                        'gym_address.required' => __('translation.require_gym_address'),
                        'gym_phone.regex' => __('translation.require_gym_phone'),
                        'profile_image' =>   __('translation.file_not_autorized'),
                        'imgs_gallery' =>   __('translation.file_not_autorized')
                    ],
                );



        // save gym in gym table
        $gym->name = $request['gym_name'];
        $gym->phone = $request['gym_phone'];
        $gym->address = $request['gym_address'];
        $gym->desc = $request['gym_desc'];
        $gym->is_main = $request['is_main'];
        $gym->created_by = $user->id;
        $gym->account_id = auth()->user()->account_id;
        $gym->save();

        // save gym profile image
        $file = $request->file('profile_image');
        if($file = $request->hasFile('profile_image')) {

              // save the file
              try {
                $extension = $request->file('profile_image')->extension();
                $fileName = "gym_image_".$request['gym_name']."_".$gym->id.'_'.time().'.'.$extension;
                $this->filesRepository->saveFile($request, $gym->id, $fileName ,$destinationPath, 'gyms', 'profile', 'profile_image');
            } catch (Throwable $e) {
                report($e);
        
                return $e;
            }

        }

         // save gallory images in files tabele
         if($request->hasFile('imgs_gallery')) {
            foreach($request->file('imgs_gallery') as $image)
            {// save the file
                try {
                    $extension = $request->file('imgs_gallery')->extension();
                    $fileName = "gym_image_".$request['gym_name']."_".$gym->id.'_'.time().'.'.$extension;
                    $this->filesRepository->saveFile($request, $gym->id, $fileName ,$destinationPath, 'gyms', 'profile', 'imgs_gallery');
                } catch (Throwable $e) {
                    report($e);
            
                    return $e;
                }
            }
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
        $user = auth()->user();
        $gym = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->select('gyms.*','gyms.name as gym_name', 'gyms.created_at as gym_created_at', 'users.name as user_name')
            ->where([
                    ['gyms.id', $id],
                    ['gyms.account_id', $user->account_id],
                ]
                )->first();

        return view('gym.show',
            array( 
            "gym" => $gym,
            "gym_name"  => $gym->gym_name
       ));
    }

    public function edit($id)
    {
        $user = auth()->user();
        $gym = DB::table('gyms')
            ->select('gyms.*')
            ->where([
                ['gyms.id', $id],
                ['gyms.account_id', $user->account_id],
            ]
                )->first();

        return view('gym.edit', compact('gym'));
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
                        'gym_name' => 'required',
                        //'gym_address' => 'required',
                        'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ],
                    [
                        'gym_name.required' => __('translation.require_gym_name'),
                        //'gym_address.required' => __('translation.require_gym_address'),
                        'profile_image' =>   __('translation.file_not_autorized')
                    ],
                );


           
            // update member in member table
            $this->gymsRepository->updateGym($request);
            return redirect()->route('show_gym', [
                'id' => $request['gym_id']
            ]);
    }
}
