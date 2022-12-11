<?php
namespace App\Http\Controllers;

use App\Models\Gyms;
use Illuminate\Http\Request;

class GymsController extends Controller{
      /**
     * Show all gym.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $gyms = Gyms::orderBy("created_at", "asc")->get();
        dd($gyms);
    }
}