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
      

        if($request->isMethod('get')){
            $query = $request['query'];
            $services = Services::select('id','name', 'description')
                ->where('name','LIKE','%'.$query.'%')
                ->orWhere('description', 'like', '%'. $query .'%')
                ->paginate(10);
            $count = $services->count();
            return view('services.service_list' , compact('services', 'count'));
        }else{
            $services = Services::paginate(10);
            $count = $services->count();
            return redirect()->route('services_list');
        }

        return view('services.service_list' , compact('services', 'count'));
    }
}
