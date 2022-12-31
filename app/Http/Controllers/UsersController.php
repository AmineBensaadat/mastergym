<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\User;
use App\Models\UsersGym;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
    public function show()
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
        $gyms = Gyms::all();
        return view('users.user_create', compact('gyms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
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
            $usersgym = UsersGym::all();
            if (request()->has('profile_image')) {
                $avatar = request()->file('profile_image');
                $fileName = time().rand(100,999).preg_replace('/\s+/', '', $avatar->getClientOriginalName());
                $avatarPath = public_path('/images/users');
                $avatar->move($avatarPath, $fileName);
                
                User::create([
                    'name' => $request['user_name'],
                    'email' => $request['user_email'],
                    'password' => Hash::make($request['user_password']),
                    'avatar' =>  $fileName,
                ]);
            }else{
                $user = User::create([
                    'name' => $request['user_name'],
                    'email' => $request['user_email'],
                    'password' => Hash::make($request['user_password']),
                    'avatar' =>  'default_user_profile_img.jpg',
                ]);
            }

             // save users_gyms table
              $usersgym = new UsersGym();
              $user_id = auth()->user()->id;
              $usersgym->gym_id = $request['gym'];
              $usersgym->user_id = $user_id; 
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
}
