<?php
namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Repositories\GymsRepository;
use App\Repositories\MembersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GymsController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $gymsRepository;
    private $membersRepository;

    public function __construct(GymsRepository $gymsRepository, MembersRepository $membersRepository)
    {
        $this->gymsRepository = $gymsRepository;
        $this->membersRepository = $membersRepository;
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

    public function store(Request $request)
    {
        // tables
        $gym= new Gyms();

        $destinationPath = public_path().'/assets/images/gyms/' ;
        $user_id = auth()->user()->id;

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
        $gym->created_by = $user_id;
        $gym->account_id = auth()->user()->account_id;
        $gym->save();

        // save gym profile image
        $file = $request->file('profile_image');
        if($file = $request->hasFile('profile_image')) {

            // file data
            $file = $request->file('profile_image') ;
            $fileName = time().rand(100,999).preg_replace('/\s+/', '', $file->getClientOriginalName());
            $extension = $request->file('profile_image')->extension();

            // save gym image in file table
            $files_table= new Files();
            $files_table->name = $fileName;
            $files_table->ext = $extension;
            $files_table->type = 'profile';
            $files_table->entity_name = 'gyms';
            $files_table->entitiy_id = $gym->id;
            $files_table->save();

            // move file in dericory
            $file->move($destinationPath,$fileName);

        }

         // save gallory images in files tabele
         if($request->hasFile('imgs_gallery')) {
            foreach($request->file('imgs_gallery') as $image)
            {
                $files_table= new Files();
                $fileName = time().rand(100,999).preg_replace('/\s+/', '', $image->getClientOriginalName());
                // save gym image in file table
                $files_table->img_name = $fileName;
                $files_table->ext = $image->extension();
                $files_table->type = 'gallory';
                $files_table->entitiy_id = $gym->id;
                $files_table->save();

                // move file in dericory
                $image->move($destinationPath,$fileName);
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
