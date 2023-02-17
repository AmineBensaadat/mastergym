<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Repositories\FilesRepository;
use App\Repositories\GymsRepository;
use App\Repositories\InvoicesRepository;
use App\Repositories\MembersRepository;
use App\Repositories\SubscriptionsRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class InvoicesController extends Controller
{
    private $invoicesRepository;
    private $filesRepository;
    private $gymsRepository;

    public function __construct(InvoicesRepository $invoicesRepository, FilesRepository $filesRepository, GymsRepository $gymsRepository)
    {
        $this->invoicesRepository = $invoicesRepository;
        $this->filesRepository = $filesRepository;
        $this->gymsRepository = $gymsRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $invoices = $this->invoicesRepository->getAllInvoices();
        return view('invoices.list', compact('invoices'));
    }

    public function downloadInvoice($id){
        $invoices = $this->invoicesRepository->getInvoiceById($id);
        if($invoices){
            
            $file_name = $invoices->firstname.' '.$invoices->lastname.'_'.date("Y-m-d").'.pdf';
            $gym_img = $this->filesRepository->getFileByEntityId($invoices->gym_id, "gyms");
           
            $data = [
                'invoices' => $invoices,
                'gym_img' => $gym_img,
                'date' => date('m/d/Y')
            ];
            // $pdf = Pdf::loadView('invoices.invoice', $data);
         
            // return $pdf->download($file_name);

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('invoices.payment_receipt', $data)->setPaper('A5', 'portrait')->setWarnings(false);
            return $pdf->stream();
    
        }else{
            dd("no data");
        }
        
    }


}
