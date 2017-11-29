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
		</div>
	</div>
</div>
@endsection


