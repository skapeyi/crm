@extends('adminlte::page')

@section('title','Subscribed Individuals')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="min-height: 75px;">
				<h3 class="panel-title">All Members</h3>
				<div class="btn-group pull-right">
					<a href="/members/create" class="btn btn-default btn-sm" title="New member"><i class="fa fa-plus" aria-hidden="true"></i> New</a>
					<a href="/import-members" class="btn btn-default btn-sm" title="Import"><i class="fa fa-upload" aria-hidden="true"></i> Import</a>
					<a href="/export-members" class="btn btn-default btn-sm" title="Import"><i class="fa fa-download" aria-hidden="true"></i> Export</a>					
				</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-stripped" id="individual-table">
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
</div>

@endsection

@push('scripts')

<script>
	$(function() {
		$('#individual-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('subscriberdata') !!}',
			columns: [				
			{ data: 'name', name: 'name' },
			{ data: 'email', name:'email'},
			{ data: 'phone', name: 'phone'},
			{ data: 'level', name: 'level'},
			{ data: 'payment_status', name: 'payment_status'},
			{ data: 'created_by', name: 'created_by'},
			{ data: 'updated_by', name: 'updated_by'},
			{ data: 'action', name: 'action'}
			],
			buttons: ['excel']
		});
	});
</script>
@endpush