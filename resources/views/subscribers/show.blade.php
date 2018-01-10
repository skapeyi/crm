@extends('adminlte::page')
@push('css')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">			
			<div class="panel-body">
				<table class=   "table table-striped table-hover">
					<tbody>
						<tr>
							<td>Name:</td>
							<td>{{$subscriber->name}}</td>
						</tr>
						<tr>
							<td>Phone: </td>
							<td>{{$subscriber->phone}}</td>
						</tr>
						<tr>
							<td>Email: </td>
							<td>{{$subscriber->email}}</td>
						</tr>
						<tr>
							<td>Alternative Phone: </td>
							<td>{{$subscriber->phone_alt}}</td>
						</tr>
						<tr>
							<td>Alternative Email: </td>
							<td>{{$subscriber->email_alt}}</td>
						</tr>
						<tr>
							<td>Payment Status: </td>
							<td>{{$subscriber->payment_status}}</td>
						</tr>


					</tbody>
				</table>  
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<h4 class="panel-title pull-left"> Subscriber Payment History</h4>
				<a class="btn btn-primary btn-small pull-right" href="/subscriber-payment/{{$subscriber->id}}/addpayment" title="Add Payment">New</a>
				<div class="clearfix"></div>
			</div
			<div class="panel-body">
				@if(count($subscriber->payments) < 1)
					<p>No Payments made yet</p>
				@else
				<ul class="event-list">
					
					@foreach($subscriber->payments as $item)
					<?php 
						$_date = explode('-', $item->payment_date);
						$_month = date("M", mktime(0, 0, 0, $_date[1], 10));
					?>
					 <li>
						<time datetime="{{$item->payment_date}}">
							<span class="day">{{$_date[2]}}</span>
							<span class="month">{{$_month}}</span>
							<span class="year">{{$_date[0]}}</span>

						</time>
						
						<div class="info">
							<h2 class="title">Paid: {{$item->amount}}</h2>
							<h2 class="title">Balance: {{$item->balance}}</h2>
							<h2 class="title">Expiry Date: {{$item->expiry_date}}</h2>
							<p class="desc">Comments: {{$item->comments}}</p>
						</div>
						
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection


