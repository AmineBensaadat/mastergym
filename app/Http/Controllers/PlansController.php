<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class PlansController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all gym.
     *
     * @return Response
     */
    public function index()
    {
        $gyms = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->join('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('gyms.id as gym_id', 'files.name as gym_img','files.ext','gyms.name as gym_name', 'gyms.created_at as gym_created_at', 'users.name as user_name')
            ->where('files.type', 'profile')
            ->orderBy("gyms.created_at", "asc")->get();
        //$gyms = Gyms::orderBy("created_at", "asc")->get();
        return view('gym.gym_lists', compact('gyms'));
    }
}