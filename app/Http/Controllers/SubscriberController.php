<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Auth;
use Excel;
use DataTables;
use Carbon\Carbon;
use App\Subscriber;
use App\SubscriberPayment;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriberCreateRequest;

class SubscriberController extends Controller
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
        return view('subscribers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = ['Individual - Corporate' => 'Individual - Corporate', 'Individual - Student' => 'Individual - Student'];
        $payment_status = ['Paid' => 'Paid', 'Un-Paid' => 'Un-Paid', 'Expired' => 'Expired'];
        return view('subscribers.create', compact('levels','payment_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriberCreateRequest $request)
    {
        $sub = new Subscriber();
        $sub->name = $request->name;
        $sub->phone = $request->phone;
        $sub->phone_alt = $request->phone_alt;
        $sub->email = $request->email;
        $sub->email_alt = $request->email_alt;
        $sub->level = $request->level;
        $sub->payment_status = $request->payment_status;
        $sub->created_by = Auth::user()->id;
        $sub->updated_by = Auth::user()->id;
        try {
            if($sub->save()){
                //ToDo - Send User Email
                flash('Saved new subsciber')->success();
                //ToDo - Go to view page and show payment and details
                return redirect('/members');
            }
        } catch (\Exception $e) {
            flash("Ooops, please contact your system admin!")->error();
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
        $subscriber = Subscriber::find($id);

        return view('subscribers.show', compact('subscriber'));
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
    public function get_subscriber_data(){
        $query = DB::table('subscribers as s')
        ->join('users as u','s.created_by','=','u.id')
        ->join('users as u1','s.updated_by','=','u1.id')
        ->select('s.id','s.name','s.phone','s.phone_alt','s.email','s.email_alt','s.level','s.payment_status','u.name as created_by','u1.name as updated_by');

        return Datatables::of($query)->addColumn('action', function($subscriber){
            return '<a href="members/'.$subscriber->id.'" title="View Details"><i class="fa fa-eye"></i></a>';
        })->make(true);
    }

    public function import(){
        return view('subscribers.import');
    }

    public function save_import(Request $request){
        if($request->hasFile('members_file')){
            $path = $request->file('members_file')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            $existing_members = [];
            if($data->count()){
                foreach($data as $key => $value){
                    Log::info($value);
                    if($value->name != NULL &&  $value->email != NULL){
                        $member = Subscriber::where('email',$value->email)->first();
                        if(empty($member)){
                            $member = new Subscriber();
                            $member->name = $value->name;
                            $member->phone = $value->telephone;
                            $member->phone_alt = $value->telephone_2;
                            $member->email = $value->email;
                            $member->email_alt = $value->email_2;
                            $member->level = $value->level;
                            $member->payment_status = $value->payment_status;
                            $member->created_by = Auth::user()->id;
                            $member->updated_by = Auth::user()->id;

                            if($member->save()){
                                //we need to create the subscription info here
                                $payment = new SubscriberPayment();
                                $payment->amount = $value->amount;
                                $payment->subscriber_id = $member->id;
                                if(!empty($value->payment_date)){
                                    $payment->payment_date = $value->payment_date->date;
                                    $payment->expiry_date = Carbon::parse($payment->payment_date)->addMonths(12);
                                }                                
                                
                                $payment->created_by = Auth::user()->id;
                                $payment->updated_by = Auth::user()->id;
                                $payment->save();
                            }
                        }else{
                            $existing_members[] = $member->email;
                        }
                    }
                }
                foreach ($existing_members as $item) {
                    flash($item. ' already exists and has not been processed');
                }
                return view('subscribers.index');
            }else{
                flash("File is empty")->error();
                return redirect()->back();
            }
        }

        else{
            flash("Please upload file to import")->error();
            return redirect()->back();
        }
    }

}
