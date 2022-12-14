<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Repositories\InvoicesRepository;
use App\Repositories\MembersRepository;
use App\Repositories\SubscriptionsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvoicesController extends Controller
{
    private $membersRepository;
    private $invoicesRepository;

    public function __construct(InvoicesRepository $invoicesRepository)
    {
        $this->invoicesRepository = $invoicesRepository;
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


}
