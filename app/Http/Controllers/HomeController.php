<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Subscriber;
use App\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $today = Carbon::now();
        $one_month_after = $today->addMonths(1)->toDateString();
        $total_members = DB::table('subscribers')->count();
        $total_organizations = DB::table('organizations')->count(); 

        $members_expiring_query = DB::table('subscribers as s')
                                ->join('subscriber_payments as sp','s.id','=','sp.subscriber_id')
                                ->select('s.name', 's.email','s.phone','sp.payment_date','sp.expiry_date')
                                ->whereDate('sp.expiry_date','<=',$one_month_after)
                                ->orderBy('sp.expiry_date','ASC')
                                ->groupBy('s.email');       
        
        $members_expiring_soon = $members_expiring_query->simplePaginate(10,['*'],'members');

        $organizations_expiring_query = DB::table('organizations as o')
                                ->join('organization_payments as op','o.id','=','op.organization_id')
                                ->select('o.name', 'o.email','o.phone','op.payment_date','op.expiry_date')
                                ->whereDate('op.expiry_date','<=',$one_month_after)
                                ->orderBy('op.expiry_date','ASC')
                                ->groupBy('o.email');       
        
        $organizations_expiring_soon = $organizations_expiring_query->simplePaginate(10,['*'],'organizations');

        return view('home', compact('total_members','total_organizations','members_expiring_soon','organizations_expiring_soon'));
    }
}
