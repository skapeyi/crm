<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use Carbon\Carbon;
use App\Organization;
use App\OrganizationPayment;
use App\Http\Requests\OrganizationpaymentCreateRequest;
use Illuminate\Http\Request;

class OrganizationpaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($organization)
    {
        $organization = Organization::find($organization);
        return view('organizations.payments.create', compact('organization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationpaymentCreateRequest $request)
    {
        $pay = new OrganizationPayment();
        $pay->amount = $request->amount;
        $pay->balance = $request->balance;
        $pay->organization_id = $request->organization;
        $pay->payment_date = $request->payment_date;

        // ToDo for partial payments, the increase shouldn't be for a whole year. Think about the different scnenarios! 
        $pay->expiry_date = Carbon::parse($request->payment_date)->addMonths(12);
        $pay->comments = $request->comments;
        $pay->created_by = Auth::user()->id;
        $pay->updated_by = Auth::user()->id;
        try {
            if($pay->save()){
                //ToDo - Update organization payment status
                flash('Payment saved')->success();
                return redirect('/organizations/'.$request->organization);
            }
        } catch (\Exception $e) {
            Log::info($e);
            flash('Something went wrong, please contact your administrator')->error();
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
}
