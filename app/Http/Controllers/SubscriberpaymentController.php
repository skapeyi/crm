<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use Carbon\Carbon;
use App\Subscriber;
use App\SubscriberPayment;
use App\Http\Requests\SubscriberpaymentCreateRequest;
use Illuminate\Http\Request;

class SubscriberpaymentController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subscriber)
    {
        $subscriber = Subscriber::find($subscriber);
        return view('subscribers.payments.create',compact('subscriber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriberpaymentCreateRequest $request)
    {
        $pay = new SubscriberPayment();
        $pay->amount = $request->amount;
        $pay->balance = $request->balance;
        $pay->subscriber_id = $request->subscriber;
        $pay->payment_date = $request->payment_date;

        // ToDo for partial payments, the increase shouldn't be for a whole year. Think about the different scnenarios! 
        $pay->expiry_date = Carbon::parse($request->payment_date)->addMonths(12);
        $pay->comments = $request->comments;
        $pay->created_by = Auth::user()->id;
        $pay->updated_by = Auth::user()->id;
        try {
            if($pay->save()){
                //ToDo - Update Subscriber payment status
                //ToDo - We can also send people emails to notify them about their payments
                flash('Payment saved')->success();
                return redirect('/members/'.$request->subscriber);
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
