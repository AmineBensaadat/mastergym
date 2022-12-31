<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Repositories\GymsRepository;
use App\Repositories\MembersRepository;
use App\Rules\IsSelected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MembersController extends Controller
{
    private $membersRepository;
    private $gymsRepository;

    public function __construct(MembersRepository $membersRepository, GymsRepository $gymsRepository)
    {
        $this->membersRepository = $membersRepository;
        $this->gymsRepository = $gymsRepository;
        $this->gyms = $membersRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $members = $this->membersRepository->all();
        return view('members.list', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $gyms =  $this->gymsRepository->renderAllGymByCretedById();
        $services =  $this->gymsRepository->renderAllGymByCretedById();
   
        return view('members.create', compact('gyms','services'));
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
                    'cin' => 'required|unique:members',
                    'address' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email|unique:members',
                    'dob' => 'required',
                    'emergency_cont' => 'required',
                    'gym' => new IsSelected,
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
                    'gym.required' => __('require')
                ],
            );
            dd($request['gym']);
            $members = $this->membersRepository->saveMember($request);
          
            return redirect()->route('members_list');
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

    /**
     * Show member.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $member = DB::table('members')
            ->join('files', 'members.id', '=', 'files.entitiy_id')
            ->select('files.name as img_name','members.*')
            ->where('members.id', $id)->first();

        return view('members.show', array("member"  => $member));
    }

}
