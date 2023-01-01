<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
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
        $curtentUser = $this->userRepository->getCurrentUser();
        return view('setting.index', compact('curtentUser'));
    }

    public function storeLang(Request $request){

        $result = $this->userRepository->updateUserLang($request);
        return $result;
        
    }


}
