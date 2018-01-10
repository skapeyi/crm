@extends('adminlte::page')

@section('title', 'ICTAU CRM')

@section('content_header')
<h1>Members Expiring Soon</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
			<div class="panel-header">

			</div>
			<div class="panel-body">
				@if(count($members_expiring_soon) < 0 )
				<p>You have no subscriptions ending in the next 30 days</p>
				@else
				<div class="table-responsive">
					<table class="table table-striped">
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
	</div>
@endsection