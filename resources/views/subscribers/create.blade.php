@extends('adminlte::page')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title pull-left">	Add New Member </h2>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body table-responsive">
				{!! Form::open(['route' => 'subscribers.store']) !!}
				
				

				<div class="form-group">
					{!! Form::label('name','Name')!!}
					{!! Form::text('name','',['class' => 'form-control']) !!}
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif	
				</div>
				<div class="form-group">
					{!! Form::label('phone','Telephone Number')!!}
					{!! Form::text('phone','',['class' => 'form-control']) !!}
					@if ($errors->has('phone'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('phone_alt','Alternative Telephone Number')!!}
					{!! Form::text('phone_alt','',['class' => 'form-control']) !!}
					@if ($errors->has('phone_alt'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('email','Email')!!}
					{!! Form::text('email','',['class' => 'form-control']) !!}
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('email_alt','Alternative Email')!!}
					{!! Form::text('email_alt','',['class' => 'form-control']) !!}
					@if ($errors->has('email_alt'))
					<span class="help-block">
						<strong>{{ $errors->first('email_alt') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('level','Level')!!}
					{!! Form::select('level',$levels,null,['class' => 'form-control','placeholder' => 'Select Subscriber Level']) !!}
					@if ($errors->has('level'))
					<span class="help-block">
						<strong>{{ $errors->first('level') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('payment_status','Payment Status')!!}
					{!! Form::select('payment_status',$payment_status, null,['class' => 'form-control','placeholder' => 'Select Payment Status']) !!}
					@if ($errors->has('payment_status'))
					<span class="help-block">
						<strong>{{ $errors->first('payment_status') }}</strong>
					</span>
					@endif
				</div>
				
				<div class="form-group">
					{!! Form::submit('Save Subscriber',['class'=>'btn btn-primary']) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection


