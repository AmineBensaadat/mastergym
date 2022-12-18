<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = "Camille Lesch";
        $services = Services::select('id','name', 'description')
              ->where('name','LIKE','%'.$query.'%')
              ->orWhere('description', 'like', '%'. $query .'%')
              ->paginate(3);


        
        // $services = Services::latest()
        //     ->where('name', 'like', '%'. $query .'%')
        //     ->orWhere('description', 'like', '%'. $query .'%')->get();
        //$services = Services::search('aa')->paginate(3);
        dd($services);
        // $services = Service::search('"'.$request->input('search').'"')->paginate(10);
        // $count = $services->count();

        //return view('services.index', compact('services', 'count'));
    }
}
