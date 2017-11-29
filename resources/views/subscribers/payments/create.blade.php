@extends('adminlte::page')

@push('css')
<link href="{{ asset('jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title pull-left">	Add Payment for {{$subscriber->name}} </h2>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive">
				{!! Form::open(['route' => 'subscriber-payment.store']) !!}
				
				{!! Form::hidden('subscriber',$subscriber->id) !!}

				<div class="form-group">
					{!! Form::label('amount','Amount')!!}
					{!! Form::text('amount','',['class' => 'form-control']) !!}
					@if ($errors->has('amount'))
					<span class="help-block">
						<strong>{{ $errors->first('amount') }}</strong>
					</span>
					@endif	
				</div>
				<div class="form-group">
					{!! Form::label('balance','Balance Due')!!}
					{!! Form::text('balance','',['class' => 'form-control']) !!}
					@if ($errors->has('balance'))
					<span class="help-block">
						<strong>{{ $errors->first('balance') }}</strong>
					</span>
					@endif	
				</div>
				<div class="form-group">
					{!! Form::label('payment_date','Date Of Payment')!!}
					{!! Form::text('payment_date','',['class' => 'form-control datepicker']) !!}
					@if ($errors->has('payment_date'))
					<span class="help-block">
						<strong>{{ $errors->first('payment_date') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('comments','Any Comments')!!}
					{!! Form::textarea('comments','',['class' => 'form-control']) !!}
					@if ($errors->has('comments'))
					<span class="help-block">
						<strong>{{ $errors->first('comments') }}</strong>
					</span>
					@endif
				</div>				
				
				<div class="form-group">
					{!! Form::submit('Save Payment Details',['class'=>'btn btn-primary']) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
	$('.datepicker').datepicker({
		'dateFormat': 'yy-mm-dd'
	});
</script>
@endpush


