@extends('adminlte::page')

@section('title','Subscribed Organizations')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-bordered table-responsive" id="organization-table">
					<thead>
						<tr>						
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Level</th>
							<th>Payment Status</th>
							<th>Created By</th>
							<th>Updated By</th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
	$(function() {
		$('#organization-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('organizationdata') !!}',
			columns: [				
			{ data: 'name', name: 'name' },
			{ data: 'email', name:'email'},
			{ data: 'phone', name: 'phone'},
			{ data: 'level', name: 'level'},
			{ data: 'payment_status', name: 'payment_status'},
			{ data: 'created_by', name: 'created_by'},
			{ data: 'updated_by', name: 'updated_by'},
			{ data: 'action', name: 'action'}
			]
		});
	});
</script>
@endpush