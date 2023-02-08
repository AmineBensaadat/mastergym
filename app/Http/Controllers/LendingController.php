<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LendingController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('lending.index');
    }

   
}
