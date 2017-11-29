<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Auth;
use DataTables;
use App\Organization;

use App\Http\Requests\OrganizationCreateRequest;
use Illuminate\Http\Request;

class OrganizationController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('organizations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = ['Level One' => 'Telecommunications companies, ICT Manufacturers and equipment suppliers, MNCs operating in Uganda','Level Two' => 'Other large corporations NOT directly in the ICT Industry','Level Three' => 'Ugandan Software development companies and distributors, computer hardware dealers and distributors, web hosting companies, web design companies, IT support companies and solutions companies' ];
        $payment_status = ['Paid' => 'Paid', 'Un-Paid' => 'Un-Paid', 'Expired' => 'Expired'];
        return view('organizations.create',compact('levels','payment_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationCreateRequest $request)
    {
        $org = new Organization();
        $org->name = $request->name;
        $org->address = $request->address;
        $org->phone = $request->phone;
        $org->phone_alt  = $request->phone_alt;
        $org->email = $request->email;
        $org->email_alt = $request->email_alt;
        $org->level = $request->level;
        $org->payment_status = $request->payment_status;
        $org->created_by = Auth::user()->id;
        $org->updated_by = Auth::user()->id;

        try {
            if($org->save()){
                //ToDo - Send user email
                flash("Added new organizations")->success();
                //ToDo - Goto to view page and show payments and details
                return redirect('/organizations');
            }
        } catch (\Exception $e) {
            flash("Ooops, please contact your system admin")->error();
            Log::info($e);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_organization_data(){
        $query = DB::table('organizations as o')
        ->join('users as u','o.created_by','=','u.id')
        ->join('users as u1','o.updated_by','=','u1.id')
        ->select('o.id','o.name','o.phone','o.phone_alt','o.email','o.email_alt','o.level','o.payment_status','u.name as created_by','u1.name as updated_by');

        return Datatables::of($query)->addColumn('action', function($organization){
            return '<a href="organizations/'.$organization->id.'" title="View Details"><i class="fa fa-eye"></i></a>';
        })->make(true);
    }
}
