<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\User;
use App\Models\UsersGym;
use App\Repositories\FilesRepository;
use App\Repositories\GymsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    
    private $userRepository;
    private $gymsRepository;
    private $filesRepository;
    public function __construct(UserRepository $userRepository, GymsRepository $gymsRepository, FilesRepository $filesRepository)
    {
        $this->userRepository = $userRepository;
        $this->gymsRepository = $gymsRepository;
        $this->filesRepository = $filesRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.users_list', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       $gyms = $this->gymsRepository->getAllGymByCretedById();
        return view('users.user_create', compact('gyms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        //validation form 
        $this->validate(
            $request, 
                [
                    'user_name' => 'required',
                    'user_email' => 'required|email',
                    'user_password' => 'required',
                    'gym' => 'required'
                ],
                [
                    'user_name.required' => __('translation.require'),
                    'user_email.required' => __('translation.require_email'),
                    'user_password.required' => __('translation.require_password'),
                    'gym.required' =>  __('translation.require_gym')
                ],
            );
  
                $user_inserted = User::create([
                    'name' => $request['user_name'],
                    'email' => $request['user_email'],
                    'password' => Hash::make($request['user_password']),
                    'account_id'  => $user->account_id,
                    'default_gym_id'  => $request['gym'],
                ]);
            

             // save users_gyms table
              $usersgym = new UsersGym();
              $usersgym->gym_id = $request['gym'];
              $usersgym->user_id = $user_inserted->id; 
              $usersgym->save();

              session(['stored' => true]);
            return redirect()->route('users_list');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        $user->status = $request->status;

        $user->update();
        $user->photo = \constFilePrefix::staffPhoto.$user->id.'.jpg';
        $user->save();

        \Utilities::uploadFile($request, \constFilePrefix::staffPhoto, $user->id, 'photo', \constPaths::staffPhoto);

        flash()->success('User details was successfully updated');

        return redirect('users');
    }

    public function archive($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->status = \constStatus::Archive;
        $user->save();
        flash()->error('User was successfully deleted');

        return redirect('users');
    }

    public function getAllUsers(Request $request)
    {

        $result = $this->userRepository->getAllUsersByFilters($request);
        $recordsTotal = $this->userRepository->countAllMembers($request);
        $url = url('/assets/images/');
        $data = array();
        foreach($result["all_result"] as $row)
        {
            $sub_array = array();
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0">
                    <img src="'.$url.'//users/'.$this->filesRepository->getFileByEntityId($row->id, "users", "profile").'" alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 name"><a href="../users/show/'.$row->id. '">'.$row->name.'</a></div>            
            </div>';
            $sub_array[] = '
            <div class="d-flex align-items-center">            
                <div class="flex-shrink-0 ">
                    <img src="'.$url.'//gyms/'.$this->filesRepository->getFileByEntityId($row->gym_id, "gyms", "profile").'" alt="" class="avatar-xs">
                </div>
                <div class="flex-grow-1 ms-2 name">'.$row->gym_name.'</div>            
            </div>';
    
            $data[] = $sub_array;
        }

        $number_filter_row = count($result["result"]);
        $output = array(
            "draw"       =>  intval($request["draw"]),
            "recordsTotal"   =>  $recordsTotal ,
            "recordsFiltered"  => $number_filter_row,
            "data"       =>  $data
           );

        return json_encode($output) ;
    }
}
