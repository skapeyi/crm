<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class SubscriberController extends Controller
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
    public function store(Request $request)
    {
        //
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
    public function get_subscriber_data(){
        $query = DB::table('subscribers as s')
        ->join('users as u','s.created_by','=','u.id')
        ->join('users as u1','s.updated_by','=','u1.id')
        ->select('s.id','s.name','s.phone','s.phone_alt','s.email','s.email_alt','s.level','s.payment_status','u.name as created_by','u1.name as updated_by');
        return DataTables::of($query)->make(true);
    }

}
