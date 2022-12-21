<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
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
        return view('users.user_create');
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
                    'user_password' => 'required'
                ],
                [
                    'user_name.required' => __('translation.require'),
                    'user_email.required' => __('translation.require_email'),
                    'user_password.required' => __('translation.require_password')
                ],
            );
            // request()->file('avatar');
            if (request()->has('avatar')) {
                $avatar = request()->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatarPath = public_path('/images/');
                $avatar->move($avatarPath, $avatarName);
            }else{
                $user = User::create([
                    'name' => $request['user_name'],
                    'email' => $request['user_email'],
                    'password' => Hash::make($request['user_password']),
                    'avatar' =>  'default_user_profile_img.jpg',
                ]);
            }
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
