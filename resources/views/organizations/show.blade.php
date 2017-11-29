@extends('adminlte::page')

@section('content')
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class=   "table table-striped table-hover">
					<tbody>
						<tr>
							<td>Name:</td>
							<td>{{$organization->name}}</td>
						</tr>
						<tr>
							<td>Phone: </td>
							<td>{{$organization->phone}}</td>
						</tr>
						<tr>
							<td>Email: </td>
							<td>{{$organization->email}}</td>
						</tr>
						<tr>
							<td>Alternative Phone: </td>
							<td>{{$organization->phone_alt}}</td>
						</tr>
						<tr>
							<td>Alternative Email: </td>
							<td>{{$organization->email_alt}}</td>
						</tr>
						<tr>
							<td>Payment Status: </td>
							<td>{{$organization->payment_status}}</td>
						</tr>


					</tbody>
				</table>  
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title pull-left"> Organization Payment History</h4>
				<a class="btn btn-primary btn-small pull-right" href="/organization-payment/{{$organization->id}}/addpayment" title="Add Payment">New</a>
				<div class="clearfix"></div>
				</div
				<div class="panel-body">
					@if(count($organization->payments) < 1)
					<p>No Payments made yet</p>
					@else
					<ul class="event-list">

						@foreach($organization->payments as $item)
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


