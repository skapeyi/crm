@extends('adminlte::page')

@section('title', 'ICTAU CRM')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h1>{{$total_members}}</h1>
			</div>
			<div class="panel-footer">
				Total Members
			</div>
		</div>    	
	</div>
	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-body">
				<h1>{{count($members_expiring_soon)}}</h1>
			</div>
			<div class="panel-footer">
				Total Members Expiring in 30 days
			</div>
		</div>    	
	</div>
	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h1>{{$total_organizations}}</h1>
			</div>
			<div class="panel-footer">
				Total Organizations
			</div>
		</div>    	
	</div>
	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-body">
				<h1>{{count($organizations_expiring_soon)}}</h1>
			</div>
			<div class="panel-footer">
				Total Organizations Expiring in 30 days
			</div>
		</div>    	
	</div>

</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-header">

			</div>
			<div class="panel-body">
				@if(count($members_expiring_soon) < 0 )
				<p>You have no subscriptions ending in the next 30 days</p>
				@else
				<div class="table-responsive">
					<table class="table table-stripped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Payment Date</th>
								<th>Expiration Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($members_expiring_soon as $item)
							<tr>
								<td>{{$item->name}}</td>
								<td>{{$item->email}}</td>
								<td>{{$item->phone}}</td>
								<td>{{$item->payment_date}}</td>
								<td>{{$item->expiry_date}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>
				{{ $members_expiring_soon->links() }}
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-header">

			</div>
			<div class="panel-body">
				@if(count($organizations_expiring_soon) < 0 )
				<p>You have no organization subscriptions ending in the next 30 days</p>
				@else
				<div class="table-responsive">
					<table class="table table-stripped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Payment Date</th>
								<th>Expiration Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($organizations_expiring_soon as $item)
							<tr>
								<td>{{$item->name}}</td>
								<td>{{$item->email}}</td>
								<td>{{$item->phone}}</td>
								<td>{{$item->payment_date}}</td>
								<td>{{$item->expiry_date}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>
				{{ $organizations_expiring_soon->links() }}
				@endif
			</div>
		</div>
	</div>
</div>
@stop