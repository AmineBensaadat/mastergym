<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Members;
use App\Repositorries\MembersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MembersController extends Controller
{
    private $membersRepository;

    public function __construct(MembersRepository $membersRepository)
    {
        $this->membersRepository = $membersRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $members = $this->membersRepository->all();
        return view('members.members_list', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $gyms = Members::all();
        return view('members.create', compact('gyms'));
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
                    'lastname' => 'required',
                    'firstname' => 'required',
                    'cin' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email',
                    'dob' => 'required',
                    'emergency_cont' => 'required',
                    // 'user_password' => 'required',
                    // 'gym' => 'required'
                ],
                [
                    'lastname.required' => __('translation.require'),
                    'firstname.required' => __('translation.require'),
                    'lastname.cin' => __('translation.require'),
                    'address.required' => __('translation.require'),
                    'phone.required' => __('translation.require'),
                    'email.required' => __('translation.require_email'),
                    'dob.required' => __('translation.require'),
                    'emergency_cont.required' => __('translation.require'),
                    // 'user_password.required' => __('translation.require_password'),
                    // 'gym.required' =>  __('translation.require_gym')
                ],
            );
            $members = $this->membersRepository->saveMember($request);
            // $usersgym = UsersGym::all();
            // if (request()->has('profile_image')) {
            //     $avatar = request()->file('profile_image');
            //     $fileName = time().rand(100,999).preg_replace('/\s+/', '', $avatar->getClientOriginalName());
            //     $avatarPath = public_path('/images/users');
            //     $avatar->move($avatarPath, $fileName);
                
            //     User::create([
            //         'name' => $request['user_name'],
            //         'email' => $request['user_email'],
            //         'password' => Hash::make($request['user_password']),
            //         'avatar' =>  $fileName,
            //     ]);
            // }else{
            //     $user = User::create([
            //         'name' => $request['user_name'],
            //         'email' => $request['user_email'],
            //         'password' => Hash::make($request['user_password']),
            //         'avatar' =>  'default_user_profile_img.jpg',
            //     ]);
            // }

            //  // save users_gyms table
            //   $usersgym = new UsersGym();
            //   $user_id = auth()->user()->id;
            //   $usersgym->gym_id = $request['gym'];
            //   $usersgym->user_id = $user_id; 
            //   $usersgym->save();
              
            //   session(['stored' => true]);
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

}
