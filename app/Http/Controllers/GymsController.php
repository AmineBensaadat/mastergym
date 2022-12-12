<?php
namespace App\Http\Controllers;

use App\Models\Gyms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GymsController extends Controller{

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
            ->select('files.name as gym_img','files.ext','gyms.name as gym_name', 'gyms.created_at as gym_created_at', 'users.name as user_name')
            ->orderBy("gyms.created_at", "asc")->get();
        //$gyms = Gyms::orderBy("created_at", "asc")->get();
        return view('gym.gym_lists', compact('gyms'));

    }

    /**
     * Show all gym.
     *
     * @return Response
     */
    public function add(Request $request)
    {
        return view('gym.gym_create');
    }


     /**
     * Show all gym.
     *
     * @return Response
     */
    public function show(Request $request)
    {
        $gym = DB::table('gyms')
            ->join('users', 'gyms.created_by', '=', 'users.id')
            ->join('files', 'gyms.id', '=', 'files.entitiy_id')
            ->select('files.name as gym_img','files.ext','gyms.name as gym_name', 'gyms.created_at as gym_created_at', 'users.name as user_name')
            ->where('gyms.id', 1)->first();

       
        return view('gym.gym_show', 
            array(
            "gym_name"  => $gym->gym_name,
            "gym_img" => $gym->gym_img,
            "ext" => $gym->ext 
       ));
    }
}