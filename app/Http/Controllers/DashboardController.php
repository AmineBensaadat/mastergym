<?php

namespace App\Http\Controllers;

use App\Repositories\MembersRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    private $userRepository;
    private $membersRepository;

    public function __construct(UserRepository $userRepository, MembersRepository $membersRepository,)
    {
        $this->userRepository = $userRepository;
        $this->membersRepository = $membersRepository;
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
        $members = $this->membersRepository->countAllMembersByGym();
        $expired_members =  $this->membersRepository->renderMembersByStatus(1);
        return view('dashboard.index', compact('curtentUser', 'members'));
    }

}
