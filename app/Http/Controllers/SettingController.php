<?php

namespace App\Http\Controllers;

use App\Repositorries\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    private $membersRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $members = 55;
        return view('setting.index', compact('members'));
    }

    public function storeLang(Request $request){

        dd($request->lang);
        
    }


}
