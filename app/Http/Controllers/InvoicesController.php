<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Repositories\FilesRepository;
use App\Repositories\GymsRepository;
use App\Repositories\InvoicesRepository;
use App\Repositories\MembersRepository;
use App\Repositories\PlansRepository;
use App\Repositories\ServicesRepository;
use App\Repositories\SubscriptionsRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class InvoicesController extends Controller
{
    private $invoicesRepository;
    private $filesRepository;
    private $servicesRepository;
    private $plansRepository;

    public function __construct(PlansRepository $plansRepository, InvoicesRepository $invoicesRepository, ServicesRepository $servicesRepository, FilesRepository $filesRepository, GymsRepository $gymsRepository)
    {
        $this->invoicesRepository = $invoicesRepository;
        $this->filesRepository = $filesRepository;
        $this->servicesRepository = $servicesRepository;
        $this->plansRepository = $plansRepository;
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
            $gym_img = $this->filesRepository->getFileByEntityId($invoices->gym_id, "gyms", "profile");
           
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

<<<<<<< HEAD
    public function edit($id){
        $invoice = $this->invoicesRepository->getInvoiceById($id);
        $services =  $this->servicesRepository->renderAllServices();
        $plans_services = $this->plansRepository->getPlansBySrvice($invoice->service_id);
        return view('invoices.edit', compact('invoice', 'services', 'plans_services'));
    }

    public function update(Request $request){
        // add invoice
        $this->invoicesRepository->updateInvoice($request);

        return redirect()->route('members_show', array('id' => $request['member_id']));
=======
    public function update($id){
        dd($id);
>>>>>>> 6df2dbe62bf38f586cab19dc156175c6e35fbba6
    }


}
