<?php

namespace App\Http\Controllers;

use App\Repositories\MembersRepository;
use App\Repositories\UserRepository;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function index(Request $request)
    {
        $user = auth()->user();
        $curtentUser = $this->userRepository->getCurrentUser();
        $expired_members =  $this->membersRepository->countMembersByStatus('expired', $request);
        $pending_paiment =  $this->membersRepository->countMembersByStatus('pending_paiment', $request);
        $monthlyJoined =  $this->membersRepository->countMembersByStatus('monthlyJoined', $request);
        $allMembers =  $this->membersRepository->countMembersByStatus('', $request);
        return view('dashboard.index', compact('curtentUser', 'expired_members',  'pending_paiment', 'monthlyJoined', 'allMembers'));
    }

    public function getStatisticData(Request $request){

        $output = array(
            "expired_members"       => $this->membersRepository->countMembersByStatus('expired', $request),
            "pending_paiment"       =>  $this->membersRepository->countMembersByStatus('pending_paiment', $request),
            "monthlyJoined"   =>  $this->membersRepository->countMembersByStatus('monthlyJoined', $request) ,
            "allMembers"  => $this->membersRepository->countMembersByStatus('', $request)
           );

          

        return json_encode($output) ;

    }

}
