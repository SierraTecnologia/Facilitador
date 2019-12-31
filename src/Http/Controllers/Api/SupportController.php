<?php

namespace Facilitador\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Plugins\Integrations\SitecPayment\SitecPayment;
use Auth;

class SupportController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myTickets = SitecPayment::getTickets();

        return view('home', compact('myTickets'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('home', compact('ticketInContent'));
    }

    public function new($toId)
    {
        $user = Auth::user();
        $response = SitecPayment::createTicket($project, $name, $howToReprodute);
        return view('home', compact('ticketInContent'));
    }

    public function show($ticketId)
    {
        $ticketInContent = SitecPayment::showTicket($ticketId);
        return view('home', compact('ticketInContent'));
    }
}
